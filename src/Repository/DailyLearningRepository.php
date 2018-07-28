<?php

namespace App\Repository;

use App\Entity\DailyLearning;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method DailyLearning|null find($id, $lockMode = null, $lockVersion = null)
 * @method DailyLearning|null findOneBy(array $criteria, array $orderBy = null)
 * @method DailyLearning[]    findAll()
 * @method DailyLearning[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DailyLearningRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, DailyLearning::class);
    }

//    /**
//     * @return DailyLearning[] Returns an array of DailyLearning objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DailyLearning
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
