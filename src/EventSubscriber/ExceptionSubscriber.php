<?php

declare(strict_types = 1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Twig\Environment;

/**
 * Class ExceptionSubscriber
 * @package App\EventSubscriber
 */
class ExceptionSubscriber implements EventSubscriberInterface
{
    /**
     * @var Environment
     */
    private $twigEngine;

    /**
     * ExceptionSubscriber constructor.
     * @param Environment $twigEngine
     */
    public function __construct(Environment $twigEngine)
    {
        $this->twigEngine = $twigEngine;
    }

    /**
     * @return array
     */
    public static function getSubscribedEvents(): array
    {
        return [KernelEvents::EXCEPTION => "handleException"];
    }

    /**
     * @param ExceptionEvent $event
     */
    public function handleException(ExceptionEvent $event): void
    {
        // récupération de l'exception
        $exception = $event->getThrowable();

        // création du contenu de la vue correspondante
        $content = $this->twigEngine->render("erreur.html.twig", [
            "messageErreur" => $exception->getMessage(),
        ]);

        // création d'une nouvelle réponse avec le contenu
        $response = new Response($content);

        $event->setResponse($response);
    }
}
