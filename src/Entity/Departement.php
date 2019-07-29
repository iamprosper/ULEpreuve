<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DepartementRepository")
 */
class Departement
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Etablissement", inversedBy="departements")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Matiere", mappedBy="departement")
     */
    private $matieres;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiche", mappedBy="departement")
     */
    private $affiches;

    public function __construct()
    {
        $this->matieres = new ArrayCollection();
        $this->affiches = new ArrayCollection();
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

    public function getEtablissement(): ?Etablissement
    {
        return $this->etablissement;
    }

    public function setEtablissement(?Etablissement $etablissement): self
    {
        $this->etablissement = $etablissement;

        return $this;
    }

    /**
     * @return Collection|Matiere[]
     */
    public function getMatieres(): Collection
    {
        return $this->matieres;
    }

    public function addMatiere(Matiere $matiere): self
    {
        if (!$this->matieres->contains($matiere)) {
            $this->matieres[] = $matiere;
            $matiere->addDepartement($this);
        }

        return $this;
    }

    public function removeMatiere(Matiere $matiere): self
    {
        if ($this->matieres->contains($matiere)) {
            $this->matieres->removeElement($matiere);
            $matiere->removeDepartement($this);
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

    /**
     * @return Collection|Affiche[]
     */
    public function getAffiches(): Collection
    {
        return $this->affiches;
    }

    public function addAffich(Affiche $affich): self
    {
        if (!$this->affiches->contains($affich)) {
            $this->affiches[] = $affich;
            $affich->setDepartement($this);
        }

        return $this;
    }

    public function removeAffich(Affiche $affich): self
    {
        if ($this->affiches->contains($affich)) {
            $this->affiches->removeElement($affich);
            // set the owning side to null (unless already changed)
            if ($affich->getDepartement() === $this) {
                $affich->setDepartement(null);
            }
        }

        return $this;
    }
}
