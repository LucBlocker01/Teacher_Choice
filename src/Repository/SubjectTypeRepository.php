<?php

namespace App\Repository;

use App\Entity\SubjectType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<SubjectType>
 *
 * @method SubjectType|null find($id, $lockMode = null, $lockVersion = null)
 * @method SubjectType|null findOneBy(array $criteria, array $orderBy = null)
 * @method SubjectType[]    findAll()
 * @method SubjectType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubjectTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SubjectType::class);
    }

//    /**
//     * @return SubjectType[] Returns an array of SubjectType objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('s.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?SubjectType
//    {
//        return $this->createQueryBuilder('s')
//            ->andWhere('s.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
