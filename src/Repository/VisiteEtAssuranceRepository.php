<?php

namespace App\Repository;

use App\Entity\VisiteEtAssurance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


class VisiteEtAssuranceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    /*public function findByDateLeasing()
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery('
            SELECT v 
            FROM App\Entity\VisiteEtAssurance v
            WHERE v.dateLeasing BETWEEN CURRENT_DATE AND CURRENT_DATE+4
        ');
        return $query->getResult();
    }*/
    

    /*
    public function findOneBySomeField($value): ?Test
    {
        return (boolean)$this->createQueryBuilder('u')
            ->where('u.dateLeasing < :date')
            ->setParameter('date', $date)
            ->getQuery()
            ->execute();
    }
    */
}
