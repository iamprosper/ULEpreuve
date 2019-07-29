<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AfficheFileRepository")
 */
class AfficheFile
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
    private $nom;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Affiche", inversedBy="fichiers")
     */
    private $affiche;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getAffiche(): ?Affiche
    {
        return $this->affiche;
    }

    public function setAffiche(?Affiche $affiche): self
    {
        $this->affiche = $affiche;

        return $this;
    }
    /**
    * toString
    * @return string
    */
    public function __toString()
    {
       return $this->nom;
    }
}
