<?php

declare(strict_types = 1);


namespace App\Controller;

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
     */
    public function detailAction($pizzeriaId): Response
    {
        return new Response("Carte de la pizzéria {$pizzeriaId}");
    }
}
