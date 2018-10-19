<?php

namespace App\\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rapport
 *
 * @ORM\Table(name="rapport", indexes={@ORM\Index(name="rapport_fk1", columns={"idVisiteur"}), @ORM\Index(name="rapport_fk2", columns={"idMedecin"})})
 * @ORM\Entity
 */
class Rapport
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var string|null
     *
     * @ORM\Column(name="motif", type="string", length=100, nullable=true)
     */
    private $motif;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bilan", type="string", length=100, nullable=true)
     */
    private $bilan;

    /**
     * @var \Visiteur
     *
     * @ORM\ManyToOne(targetEntity="Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     * })
     */
    private $idvisiteur;

    /**
     * @var \Medecin
     *
     * @ORM\ManyToOne(targetEntity="Medecin")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idMedecin", referencedColumnName="id")
     * })
     */
    private $idmedecin;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Medicament", inversedBy="idrapport")
     * @ORM\JoinTable(name="offrir",
     *   joinColumns={
     *     @ORM\JoinColumn(name="idRapport", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="idMedicament", referencedColumnName="id")
     *   }
     * )
     */
    private $idmedicament;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->idmedicament = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
