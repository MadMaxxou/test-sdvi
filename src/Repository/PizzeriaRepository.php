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
        //Test id > 0
        if(!is_numeric($pizzeriaId) || $pizzeriaId <=0){
            throw new \Exception("Impossible d'obtenir le détail d'une pizzeria({$pizzeriaId}).");
        }

        // Query builder : p = pizzeria
        $qb = $this->createQueryBuilder("p");

        //requête :
        $qb
            ->addSelect(["pizz", "qte", "ing"])
            ->innerJoin("p.pizzas", "pizz")
            ->innerJoin("pizz.quantiteIngredients", "qte")
            ->innerJoin("qte.ingredient", "ing")
            ->where("p.id = :idPizzeria")
            ->setParameter("idPizzeria", $pizzeriaId)
        ;

        //exécution
        return $qb->getQuery()->getSingleResult();
    }
}
