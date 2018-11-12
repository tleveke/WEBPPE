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
    public function finAllOrderedByDate()
    {
        $queryBuilder = $this->createQueryBuilder('rapport')
            ->orderBy('rapport.date','DESC')
            ->getQuery();
        return $queryBuilder->getResult();
    }
    public function listAction()
    {
        $products = $this->getDoctrine()
            ->getRepository(Rapport::class)
            ->finAllOrderedByDate();
    }
}
?>