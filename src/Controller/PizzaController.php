<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Repository\PizzaRepository;
use App\Entity\IngredientPizza;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PizzaController
 * @package App\Controller
 */
class PizzaController extends AbstractController
{
    /**
     * @Route("/pizzas")
     *
     * @param PizzaRepository $pizzaRepo
     *
     * @return Response
     */
    public function listeAction(PizzaRepository $pizzaRepo): Response
    {
        // récupération des différentes pizzas
        $pizzas = $pizzaRepo->findAll();

        return $this->render("Pizza/liste.html.twig", [
            "pizzas" => $pizzas,
        ]);
    }

    /**
     * @Route(
     *     "/pizzas/detail-{pizzaId}",
     *     requirements={"pizzaId": "\d+"}
     * )
     * @param PizzaRepository $pizzaRepo
     * @param int $pizzaId
     *
     * @return Response
     */
    public function detailAction($pizzaId, PizzaRepository $pizzaRepo): Response
    {
        //Récupération de findPizzaAvecDetailComplet dans PizzaRepository
        $pizzas = $pizzaRepo->findPizzaAvecDetailComplet($pizzaId);

        //Récupération de la quantite d'ingrédients
        $quantite = $pizzas->getQuantiteIngredients();

        //Initialisation du tableau pour lister les ingrédients
        $ingredient = [];

        //Initialisation du prix de fabrication
        $prix = 0;
        // On récupère le prix de chaque ingredients par rapport à son poids ainsi que son nom
        foreach ($quantite as $qte){
            $ing = $qte->getIngredient();
            //récupération des noms d'ingrédients pour les stocker dans le tableau
            $ingredient[] = $ing->getNom();
            //Calcul du prix de fabrication
            $prix += $ing->getCout() * IngredientPizza::convertirGrammeEnKilo($qte->getQuantite());

        }
        $prix = round($prix, 2);


        return $this->render("Pizza/detail.html.twig", array(
            'nom' => $pizzas->getNom(),
            'prix' => $prix,
            'ingredient' => implode(', ',$ingredient)
        ));
    }
}
