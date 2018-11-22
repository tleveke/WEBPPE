<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Search
{

    /**
     * @var string
     */
    private $grandeur;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var string
     */
    private $choixTri;

    public function getGrandeur(): ?string
    {
        return $this->grandeur;
    }

    public function setGrandeur(string $grandeur): self
    {
        $this->grandeur = $grandeur;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getChoixTri(): ?string
    {
        return $this->choixTri;
    }

    public function setChoixTri(string $choixTri): self
    {
        $this->choixTri = $choixTri;

        return $this;
    }
}
