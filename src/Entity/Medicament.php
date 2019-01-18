<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Onurb\Doctrine\ORMMetadataGrapher\Mapping as Grapher;

/**
 * Medicament
 *
 * @ORM\Table(name="medicament", indexes={@ORM\Index(name="medicament_fk", columns={"idFamille"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass="App\Repository\MedicamentRepository")
 */
class Medicament
{
    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=30, nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nomCommercial", type="string", length=80, nullable=false)
     */
    private $nomcommercial;

    /**
     * @var string
     *
     * @ORM\Column(name="composition", type="string", length=100, nullable=false)
     */
    private $composition;

    /**
     * @var string
     *
     * @ORM\Column(name="effets", type="string", length=100, nullable=false)
     */
    private $effets;

    /**
     * @var string
     *
     * @ORM\Column(name="contreIndications", type="string", length=100, nullable=false)
     */
    private $contreindications;

    /**
     * @var \Famille
     *
     * @ORM\ManyToOne(targetEntity="Famille", inversedBy="familles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFamille", referencedColumnName="id")
     * })
     */
    private $idfamille;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Rapport", mappedBy="idmedicament")
     */
    private $idrapport;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idrapport = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    /**
    * @Grapher\IsDisplayedMethod()
    */
    public function getNomcommercial(): ?string
    {
        return $this->nomcommercial;
    }

    /**
    * @Grapher\IsDisplayedMethod()
    */
    public function setNomcommercial(string $nomcommercial): self
    {
        $this->nomcommercial = $nomcommercial;

        return $this;
    }

    public function getComposition(): ?string
    {
        return $this->composition;
    }

    public function setComposition(string $composition): self
    {
        $this->composition = $composition;

        return $this;
    }

    public function getEffets(): ?string
    {
        return $this->effets;
    }

    public function setEffets(string $effets): self
    {
        $this->effets = $effets;

        return $this;
    }

    public function getContreindications(): ?string
    {
        return $this->contreindications;
    }

    public function setContreindications(string $contreindications): self
    {
        $this->contreindications = $contreindications;

        return $this;
    }

    public function getIdfamille(): ?Famille
    {
        return $this->idfamille;
    }

    public function setIdfamille(?Famille $idfamille): self
    {
        $this->idfamille = $idfamille;

        return $this;
    }

    /**
     * @return Collection|Rapport[]
     */
    public function getIdrapport(): Collection
    {
        return $this->idrapport;
    }

    public function addIdrapport(Rapport $idrapport): self
    {
        if (!$this->idrapport->contains($idrapport)) {
            $this->idrapport[] = $idrapport;
            $idrapport->addIdmedicament($this);
        }

        return $this;
    }

    public function removeIdrapport(Rapport $idrapport): self
    {
        if ($this->idrapport->contains($idrapport)) {
            $this->idrapport->removeElement($idrapport);
            $idrapport->removeIdmedicament($this);
        }

        return $this;
    }

    public function __toString()
    {
       return $this->getNomcommercial();
    }

}
