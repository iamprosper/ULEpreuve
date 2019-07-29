<?php

namespace App\Repository;

use App\Entity\AfficheFile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AfficheFile|null find($id, $lockMode = null, $lockVersion = null)
 * @method AfficheFile|null findOneBy(array $criteria, array $orderBy = null)
 * @method AfficheFile[]    findAll()
 * @method AfficheFile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AfficheFileRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AfficheFile::class);
    }

    // /**
    //  * @return AfficheFile[] Returns an array of AfficheFile objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AfficheFile
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
