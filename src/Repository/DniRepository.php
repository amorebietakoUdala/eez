<?php

namespace App\Repository;

use App\Entity\Dni;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Dni|null find($id, $lockMode = null, $lockVersion = null)
 * @method Dni|null findOneBy(array $criteria, array $orderBy = null)
 * @method Dni[]    findAll()
 * @method Dni[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Dni::class);
    }

    // /**
    //  * @return Dni[] Returns an array of Dni objects
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
    public function findOneBySomeField($value): ?Dni
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
