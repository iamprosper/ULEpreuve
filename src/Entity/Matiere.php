<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MatiereRepository")
 */
class Matiere
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="matieres")
     * @ORM\JoinColumn(nullable=false)
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Epreuves", mappedBy="matiere")
     */
    private $epreuves;

    public function __construct()
    {
        // $this->departement = new ArrayCollection();
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

    public function getDepartement(): ?Departement
    {
        return $this->departement;
    }

    public function setDepartement(?Departement $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    // public function addDepartement(Departement $departement): self
    // {
    //     if (!$this->departement->contains($departement)) {
    //         $this->departement[] = $departement;
    //     }

    //     return $this;
    // }

    // public function removeDepartement(Departement $departement): self
    // {
    //     if ($this->departement->contains($departement)) {
    //         $this->departement->removeElement($departement);
    //     }

    //     return $this;
    // }

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
            $epreufe->setMatiere($this);
        }

        return $this;
    }

    public function removeEpreufe(Epreuves $epreufe): self
    {
        if ($this->epreuves->contains($epreufe)) {
            $this->epreuves->removeElement($epreufe);
            // set the owning side to null (unless already changed)
            if ($epreufe->getMatiere() === $this) {
                $epreufe->setMatiere(null);
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
