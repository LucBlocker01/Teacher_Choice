<?php

namespace App\Repository;

use App\Entity\LessonInformation;
use App\Entity\Semester;
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

    public function getLessonBySemester(Semester $semester): array
    {
        $year = date('Y').'/'.((int) date('Y') + 1);

        return $this->createQueryBuilder('li')
            ->addSelect('c', 'lt', 'lp', 'le', 'su', 'se')
            ->leftJoin('li.choices', 'c')
            ->leftJoin('li.lessonType', 'lt')
            ->leftJoin('li.lessonPlannings', 'lp')
            ->leftJoin('li.lesson', 'le')
            ->leftJoin('le.subject', 'su')
            ->leftJoin('su.semester', 'se')
            ->andWhere('se.year LIKE :year')
            ->setParameter('year', $year)
            ->andWhere('se.id = :semester')
            ->setParameter('semester', $semester->getId())
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
