<?php

namespace App\Repository;

use App\Entity\TypeEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TypeEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeEvaluation[]    findAll()
 * @method TypeEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TypeEvaluation::class);
    }

    // /**
    //  * @return TypeEvaluation[] Returns an array of TypeEvaluation objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeEvaluation
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
