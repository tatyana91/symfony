<?php

namespace App\Repository;

use App\Entity\BookProduct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BookProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookProduct[]    findAll()
 * @method BookProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookProductRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BookProduct::class);
    }

    // /**
    //  * @return BookProduct[] Returns an array of BookProduct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookProduct
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
