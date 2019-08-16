<?php

namespace App\Repository;

use App\Entity\Cabepedv;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Cabepedv|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cabepedv|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cabepedv[]    findAll()
 * @method Cabepedv[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CabepedvRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Cabepedv::class);
    }

    // /**
    //  * @return Cabepedv[] Returns an array of Cabepedv objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Cabepedv
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
