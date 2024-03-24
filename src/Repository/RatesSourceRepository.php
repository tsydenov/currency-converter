<?php

namespace App\Repository;

use App\Entity\RatesSource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<RatesSource>
 *
 * @method RatesSource|null find($id, $lockMode = null, $lockVersion = null)
 * @method RatesSource|null findOneBy(array $criteria, array $orderBy = null)
 * @method RatesSource[]    findAll()
 * @method RatesSource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RatesSourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RatesSource::class);
    }

    //    /**
    //     * @return RatesSource[] Returns an array of RatesSource objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RatesSource
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
