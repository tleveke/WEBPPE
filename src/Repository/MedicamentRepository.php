<?php

namespace App\Repository;

use App\Entity\Medicament;
use App\Entity\Visiteur;
use App\Entity\Search;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class MedicamentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Medicament::class);
    }
    public function findLike($titre)
    {
        return $this
            ->createQueryBuilder('a')
            ->where('a.nomcommercial LIKE :titre')
            ->setParameter( 'titre', "%$titre%")
            ->orderBy('a.titre')
            ->setMaxResults(10)
            ->getQuery()
            ->execute()
            ;
    }
}
?>