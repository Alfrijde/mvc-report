<?php

namespace App\Repository;

use App\Entity\GarbageMaterialRuralKattegattOstersjon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GarbageMaterialRuralKattegattOstersjon>
 */
class GarbageMaterialRuralKattegattOstersjonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GarbageMaterialRuralKattegattOstersjon::class);
    }

    //    /**
    //     * @return GarbageMaterialRuralKattegattOstersjon[] Returns an array of GarbageMaterialRuralKattegattOstersjon objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('g.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?GarbageMaterialRuralKattegattOstersjon
    //    {
    //        return $this->createQueryBuilder('g')
    //            ->andWhere('g.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
