<?php

declare(strict_types = 1);


namespace App\Controller;

use App\Entity\IngredientPizza;
use App\Repository\PizzeriaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PizzeriaController
 * @package App\Controller
 */
class PizzeriaController extends AbstractController
{
    /**
     * @Route("/pizzerias")
     *
     * @param PizzeriaRepository $pizzeriaRepo
     *
     * @return Response
     */
    public function listeAction(PizzeriaRepository $pizzeriaRepo): Response
    {
        // récupération des différentes pizzéria de l'application
        $pizzerias = $pizzeriaRepo->findAll();

        return $this->render("Pizzeria/liste.html.twig", [
            "pizzerias" => $pizzerias,
        ]);
    }

    /**
     * @param int $pizzeriaId
     * @Route(
     *     "/pizzerias/carte-{pizzeriaId}",
     *     requirements={"pizzeriaId": "\d+"}
     * )
     * @return Response
     * @throws \Exception
     */
    public function detailAction($pizzeriaId, PizzeriaRepository $pizzeriaRepo): Response
    {

        //Récupération de findCartePizzeria, getPizza() et getMarge()
        $pizzeria = $pizzeriaRepo->findCartePizzeria($pizzeriaId);
        $pizza= $pizzeria->getPizzas();
        $marges = $pizzeria->getMarge();

        //Initialisation d'un tableau
        $pizzaPrix = [];

        // Le prix de vente de chaque pizzas est calculée avec son coût * la marge de la pizzeria
        foreach ($pizza as $p){
            $quantite = $p->getQuantiteIngredients();
            $prix = 0;

            foreach ($quantite as $qte){
                $ing = $qte->getIngredient();
                $prix += $ing->getCout() * IngredientPizza::convertirGrammeEnKilo($qte->getQuantite());
            }
            //Calcul du prix des pizzas avec la marge de la pizzeria et on le stock dans le tableau
            $pizzaPrix[$p->getNom()] = round($prix * $marges, 2);
        }


        return $this->render("Pizzeria/carte.html.twig", array(
            'nom' => $pizzeria->getNom(),
            'prix' => $pizzaPrix,
        ));
    }
}
