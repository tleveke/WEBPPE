<?php

namespace App\Repository;

use App\Entity\Rapport;
use App\Entity\Search;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class RapportRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Rapport::class);
    }
    public function finAllOrderedByDate(Search $search,Visiteur $visiteur)
    {

        $queryBuilder = $this->createQueryBuilder('rapport')
            ->where('rapport.date '.$search->getGrandeur().' :date')
            ->andWhere("rapport.idvisiteur = :id")
            ->setParameter('date', $search->getDate())
            ->setParameter('id', $visiteur->getId())
            ->orderBy('rapport.date', $search->getChoixTri())
            ->getQuery();
        return $queryBuilder->getResult();

    }
}
?>