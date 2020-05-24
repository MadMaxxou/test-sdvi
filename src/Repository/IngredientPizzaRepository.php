<?php

declare(strict_types = 1);

namespace App\Repository;

use App\Entity\IngredientPizza;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * Class IngredientPizzaRepository
 * @package App\Repository
 */
class IngredientPizzaRepository extends ServiceEntityRepository
{
    /**
     * IngredientPizzaRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IngredientPizza::class);
    }
}
