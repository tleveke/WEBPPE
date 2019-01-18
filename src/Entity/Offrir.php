<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Onurb\Doctrine\ORMMetadataGrapher\Mapping as Grapher;

/**
* @ORM\Entity
* @ORM\Table(name="offrir")
*/
class Offrir
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
    * @var \Rapport
    * @ORM\ManyToOne(targetEntity="Rapport", inversedBy="offrirs")
    * @ORM\JoinColumns({
    *   @ORM\JoinColumn(name="idRapport", referencedColumnName="id")
    * })
    */
    private $rapport;

    /**
    * @var \Medicament
    * @ORM\ManyToOne(targetEntity="Medicament")
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
    
    /**
    * @Grapher\IsDisplayedMethod()
    */
    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    /**
    * @Grapher\IsDisplayedMethod()
    */
    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }
}