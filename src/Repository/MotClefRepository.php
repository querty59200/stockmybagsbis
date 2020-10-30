<?php

namespace App\Repository;

use App\Entity\MotClef;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MotClef|null find($id, $lockMode = null, $lockVersion = null)
 * @method MotClef|null findOneBy(array $criteria, array $orderBy = null)
 * @method MotClef[]    findAll()
 * @method MotClef[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MotClefRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MotClef::class);
    }

    // /**
    //  * @return MotClef[] Returns an array of MotClef objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MotClef
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
