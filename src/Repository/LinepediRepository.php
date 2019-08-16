<?php

namespace App\Repository;

use App\Entity\Linepedi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Linepedi|null find($id, $lockMode = null, $lockVersion = null)
 * @method Linepedi|null findOneBy(array $criteria, array $orderBy = null)
 * @method Linepedi[]    findAll()
 * @method Linepedi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LinepediRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Linepedi::class);
    }

    // /**
    //  * @return Linepedi[] Returns an array of Linepedi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Linepedi
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
