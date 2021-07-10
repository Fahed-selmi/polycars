<?php

namespace App\Repository;

use App\Entity\Images;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


class ImagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Test::class);
    }

    /*public function findByIdBesoin($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.idBesoin = :val')
            ->setParameter('idBesoin', $value)
            ->orderBy('t.idBesoin', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }*/
