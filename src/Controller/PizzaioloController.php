<?php

declare(strict_types = 1);

namespace App\Controller;

use App\Repository\PizzaioloRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PizzaioloController
 * @package App\Controller
 */
class PizzaioloController extends AbstractController
{
    /**
     * @Route("/pizzaiolos/disponibles")
     *
     * @param PizzaioloRepository $pizzaioloRepo
     *
     * @return Response
     */
    public function disponiblesAction(PizzaioloRepository $pizzaioloRepo): Response
    {
        // récupération des pizzaiolos
        $pizzaiolos = $pizzaioloRepo->getAllPizzaiolos();

        return $this->render("Pizzaiolo/liste.html.twig", [
            "pizzaiolos" => $pizzaiolos,
        ]);
    }
}
