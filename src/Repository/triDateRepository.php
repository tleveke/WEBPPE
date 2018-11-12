<?php

namespace App\Repository;

use App\Entity\Rapport;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class triDateRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rapport::class);
    }
    public function OrderedByDate()
    {
        $queryBuilder = $this->createQueryBuilder('r')
            ->orderBy('r.date','DESC')
            ->getQuery();
        return $queryBuilder->getResult();
    }
}
?>