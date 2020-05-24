<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\Pizzeria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class PizzeriaRepository
 * @package App\Repository
 */
class PizzeriaRepository extends ServiceEntityRepository
{
    /**
     * PizzeriaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pizzeria::class);
    }

    /**
     * @param int $pizzeriaId
     * @return Pizzeria
     */
    public function findCartePizzeria($pizzeriaId): Pizzeria
    {
        // TODO: implémenter la méthode pour trouver la carte d'une pizzéria
        throw new \Exception("The method ".__METHOD__." isn't implemented");
    }
}
