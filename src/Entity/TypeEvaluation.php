<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TypeEvaluationRepository")
 */
class TypeEvaluation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Epreuves", mappedBy="type")
     */
    private $epreuves;

    public function __construct()
    {
        $this->epreuves = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * @return Collection|Epreuves[]
     */
    public function getEpreuves(): Collection
    {
        return $this->epreuves;
    }

    public function addEpreufe(Epreuves $epreufe): self
    {
        if (!$this->epreuves->contains($epreufe)) {
            $this->epreuves[] = $epreufe;
            $epreufe->setType($this);
        }

        return $this;
    }

    public function removeEpreufe(Epreuves $epreufe): self
    {
        if ($this->epreuves->contains($epreufe)) {
            $this->epreuves->removeElement($epreufe);
            // set the owning side to null (unless already changed)
            if ($epreufe->getType() === $this) {
                $epreufe->setType(null);
            }
        }

        return $this;
    }
    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return $this->libelle;
    }
}