<?php

namespace App\Repository;

use App\Entity\Expedient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Expedient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Expedient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Expedient[]    findAll()
 * @method Expedient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExpedientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Expedient::class);
    }

    // /**
    //  * @return Expendient[] Returns an array of Expendient objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByDates(array $criteria = null)
    {
        $qb = $this->createQueryBuilder('h');
        if (array_key_exists('fromDate', $criteria) && null !== $criteria['fromDate']) {
            $qb->andWhere('h.createDate >= :fromDate');
            $qb->setParameter('fromDate', \DateTime::createFromFormat('Y-m-d', $criteria['fromDate']));
            unset($criteria['fromDate']);
        }
        if (array_key_exists('toDate', $criteria) && null !== $criteria['toDate']) {
            $qb->andWhere('h.createDate <= :toDate');
            $qb->setParameter('toDate', \DateTime::createFromFormat('Y-m-d', $criteria['toDate']));
            unset($criteria['toDate']);
        }
        foreach ($this->__remove_blank_filters($criteria) as $key => $value) {
            $qb->andWhere('h.'.$key.'= :'.$key);
            $qb->setParameter($key, $value);
        }

        $result = $qb->getQuery()->getResult();

        return $result;
    }

    private function __remove_blank_filters($criteria)
    {
        $new_criteria = [];
        foreach ($criteria as $key => $value) {
            if (!empty($value)) {
                $new_criteria[$key] = $value;
            }
        }

        return $new_criteria;
    }

    public function findAllQueryBuilder()
    {
        return $this->createQueryBuilder('expedients');
    }
}
