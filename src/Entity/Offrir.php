<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="offrir",
*    uniqueConstraints={
*        @ORM\UniqueConstraint(name="user_poll_unique", columns={"idRapport", "idMedicament"})
*    }
*  )
*/
class Offrir
{
    /**
    * @var \Rapport 
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity=Rapport::class, inversedBy="offrirs")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="idRapport", referencedColumnName="id")
    * })
    */
    private $rapport;

    /**
    * @var \Medicament
    * @ORM\Id
    * @ORM\ManyToOne(targetEntity=Medicament::class)
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="idMedicament", referencedColumnName="id")
    * })
    */
    private $medicament;

    /**
    * @ORM\Column(name="quantite", type="integer")
    */
    private $quantite;

    
    public function getRapport(): ?Rapport
    {
        return $this->rapport;
    }

    public function setRapport(?Rapport $rapport): self
    {
        $this->rapport = $rapport;

        return $this;
    }

    public function getMedicament(): ?Medicament
    {
        return $this->medicament;
    }

    public function setMedicament(?Medicament $medicament): self
    {
        $this->medicament = $medicament;

        return $this;
    }
    
    
    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}