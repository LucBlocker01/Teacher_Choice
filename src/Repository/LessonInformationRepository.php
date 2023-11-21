<?php

namespace App\Repository;

use App\Entity\LessonInformation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<LessonInformation>
 *
 * @method LessonInformation|null find($id, $lockMode = null, $lockVersion = null)
 * @method LessonInformation|null findOneBy(array $criteria, array $orderBy = null)
 * @method LessonInformation[]    findAll()
 * @method LessonInformation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LessonInformationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, LessonInformation::class);
    }

    public function getLessonByCurrentYear(): array
    {
        $year = date('Y').'/'.((int) date('Y') + 1);

        return $this->createQueryBuilder('li')
            ->leftJoin('li.choices', 'c')
            ->andWhere('c.year LIKE :year')
            ->setParameter('year', $year)
            ->getQuery()
            ->getResult();
    }

    //    /**
    //     * @return LessonInformation[] Returns an array of LessonInformation objects
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

    //    public function findOneBySomeField($value): ?LessonInformation
    //    {
    //        return $this->createQueryBuilder('l')
    //            ->andWhere('l.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
