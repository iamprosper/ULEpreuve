<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EpreuvesRepository")
 */
class Epreuves
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank(message="Veuillez choisir un fichier pdf")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $file;

    /**
     * @ORM\Column(type="string")
     */
    private $annee;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Matiere", inversedBy="epreuves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $matiere;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Semestre", inversedBy="epreuves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $semestre;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TypeEvaluation", inversedBy="epreuves")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file): self
    {
        $this->file = $file;

        return $this;
    }

    public function getAnnee()
    {
        return $this->annee;
    }

    public function setAnnee($annee): self
    {
        $this->annee = $annee;

        return $this;
    }

    public function getMatiere(): ?Matiere
    {
        return $this->matiere;
    }

    public function setMatiere(?Matiere $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getSemestre(): ?Semestre
    {
        return $this->semestre;
    }

    public function setSemestre(?Semestre $semestre): self
    {
        $this->semestre = $semestre;

        return $this;
    }
    /**
    * toString
    * @return string
    */
    public function __toString()
    {
        return "".$this->type;
    }

    public function getType(): ?TypeEvaluation
    {
        return $this->type;
    }

    public function setType(?TypeEvaluation $type): self
    {
        $this->type = $type;

        return $this;
    }
}
