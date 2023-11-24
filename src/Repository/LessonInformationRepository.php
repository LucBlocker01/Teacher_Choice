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

    public function getLessonBySemester(string $semester): array
    {
        $year = date('Y').'/'.((int) date('Y') + 1);

        return $this->createQueryBuilder('li')
            ->select('li', 'le', 'lt', 'lp', 'c', 't', 'su', 'se')
            ->leftJoin('li.lesson', 'le')
            ->leftJoin('li.lessonType', 'lt')
            ->leftJoin('li.lessonPlannings', 'lp')
            ->leftJoin('li.choices', 'c')
            ->leftJoin('c.teacher', 't')
            ->leftJoin('le.subject', 'su')
            ->leftJoin('su.semester', 'se')
            ->andWhere('c.year LIKE :year')
            ->setParameter('year', $year)
            ->andWhere('se.name LIKE :semester')
            ->setParameter('semester', $semester)
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
