<?php

namespace App\Repository;

use App\Entity\Matiere;
use Doctrine\ORM\Query;
use App\Entity\Epreuves;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @param Matiere $matiere
 * @method Epreuves|null find($id, $lockMode = null, $lockVersion = null)
 * @method Epreuves|null findOneBy(array $criteria, array $orderBy = null)
 * @method Epreuves[]    findAll()
 * @method Epreuves[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 * @method Epreuves[]    matiereFilter($matiere)
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

    // public function findOneBySomeField($value): ?Epreuves
    // {
    //     return $this->createQueryBuilder('e')
    //         ->andWhere('e.exampleField = :val')
    //         ->setParameter('val', $value)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }

    public function matiereFilter($matiere,$semestre,$annee,$evaluation){
        $r = $this->createQueryBuilder('epreuves');
        if($matiere){
            $r->andWhere('epreuves.matiere = :ue')
            ->setParameter('ue', $matiere);
        }
        if($semestre){
            $r->andWhere('epreuves.semestre = :semestre')
            ->setParameter('semestre',$semestre);
        }
        if($annee){
            $r->andWhere('epreuves.annee = :annee')
            ->setParameter('annee',$annee);
        }
        if($evaluation){
            $r->andWhere('epreuves.type = :evaluation')
            ->setParameter('evaluation', $evaluation);
        }
        return $r->getQuery()->execute();
    }
}
