<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Ingredient;
use App\Repository\PizzaRepository;
use App\Entity\IngredientPizza;
use App\Entity\Pizza;
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
    public function detailAction(int $pizzaId, PizzaRepository $pizzaRepo): Response
    {

        dump($pizzaId);
        $pizzas = $pizzaRepo->findPizzaAvecDetailComplet($pizzaId);

        dump($pizzas);
        return $this->render("Pizza/detail.html.twig", array(
            'pizzas' => $pizzas,
        ));
    }
}
