<?php

namespace App\Repository;

use App\Entity\RGI;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RGI|null find($id, $lockMode = null, $lockVersion = null)
 * @method RGI|null findOneBy(array $criteria, array $orderBy = null)
 * @method RGI[]    findAll()
 * @method RGI[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RGIRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RGI::class);
    }

    // /**
    //  * @return RGI[] Returns an array of RGI objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RGI
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
