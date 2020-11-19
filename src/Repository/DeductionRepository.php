<?php

namespace App\Repository;

use App\Entity\Deduction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Deductions|null find($id, $lockMode = null, $lockVersion = null)
 * @method Deductions|null findOneBy(array $criteria, array $orderBy = null)
 * @method Deductions[]    findAll()
 * @method Deductions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeductionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Deduction::class);
    }

    // /**
    //  * @return Deductions[] Returns an array of Deductions objects
    //  */
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
    public function findOneBySomeField($value): ?Deductions
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
