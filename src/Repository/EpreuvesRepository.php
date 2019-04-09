<?php

namespace App\Repository;

use App\Entity\Epreuves;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Epreuves|null find($id, $lockMode = null, $lockVersion = null)
 * @method Epreuves|null findOneBy(array $criteria, array $orderBy = null)
 * @method Epreuves[]    findAll()
 * @method Epreuves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EpreuvesRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Epreuves::class);
    }

    // /**
    //  * @return Epreuves[] Returns an array of Epreuves objects
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

    /*
    public function findOneBySomeField($value): ?Epreuves
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
