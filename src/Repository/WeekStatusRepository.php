<?php

namespace App\Repository;

use App\Entity\WeekStatus;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WeekStatus>
 *
 * @method WeekStatus|null find($id, $lockMode = null, $lockVersion = null)
 * @method WeekStatus|null findOneBy(array $criteria, array $orderBy = null)
 * @method WeekStatus[]    findAll()
 * @method WeekStatus[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WeekStatusRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WeekStatus::class);
    }

    //    /**
    //     * @return WeekStatus[] Returns an array of WeekStatus objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('w.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?WeekStatus
    //    {
    //        return $this->createQueryBuilder('w')
    //            ->andWhere('w.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
