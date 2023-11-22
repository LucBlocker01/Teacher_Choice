<?php

namespace App\Repository;

use App\Entity\Choice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Choice>
 *
 * @method Choice|null find($id, $lockMode = null, $lockVersion = null)
 * @method Choice|null findOneBy(array $criteria, array $orderBy = null)
 * @method Choice[]    findAll()
 * @method Choice[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Choice::class);
    }

    public function getChoiceInformations(int $userId): array
    {
        return $this->createQueryBuilder('c')
            ->leftJoin('c.lessonInformation', 'lI')
            ->leftJoin('lI.lesson', 'le')
            ->leftJoin('le.subject', 'sub')
            ->leftJoin('sub.semester', 'sem')
            ->andWhere('c.teacher = :userId')
            ->setParameter('userId', $userId)
            ->orderBy('sem.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function getOldChoices($user): array
    {
        if (null !== $user) {
            $year = date('Y').'/'.((int) date('Y') + 1);
            $userID = $user->getId();

            $qb = $this->createQueryBuilder('c');
            $test = $qb
                ->leftJoin('c.lessonInformation', 'lI')
                ->leftJoin('lI.lesson', 'le')
                ->leftJoin('le.subject', 'sub')
                ->leftJoin('sub.semester', 'sem')
                ->andWhere('c.teacher = :userID')
                ->andWhere('c.year NOT LIKE :year')
                ->setParameter('year', $year)
                ->setParameter('userID', $userID)
                ->orderBy('sem.name', 'ASC')
                ->getQuery();

            return $test->getResult();
        } else {
            return [];
        }
    }

    //    /**
    //     * @return Choice[] Returns an array of Choice objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('c.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Choice
    //    {
    //        return $this->createQueryBuilder('c')
    //            ->andWhere('c.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
