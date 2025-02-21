<?php

namespace App\Repository;

use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recipe>
 */
class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findPublishedAndNotDeleted(): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.isPublished = :published')
            ->andWhere('r.deletedAt IS NULL')
            ->setParameter('published', true)
            ->getQuery()
            ->getResult();
    }
}
