<?php

namespace App\Repository;

use App\Entity\LessonPlanning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LessonPlanning>
 *
 * @method LessonPlanning|null find($id, $lockMode = null, $lockVersion = null)
 * @method LessonPlanning|null findOneBy(array $criteria, array $orderBy = null)
 * @method LessonPlanning[]    findAll()
 * @method LessonPlanning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonPlanningRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LessonPlanning::class);
    }

    //    /**
    //     * @return LessonPlanning[] Returns an array of LessonPlanning objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('l.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?LessonPlanning
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
