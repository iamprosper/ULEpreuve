<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AfficheRepository")
 */
class Affiche
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
    private $titre;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $detail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Utilisateur", mappedBy="liker")
     */
    private $likes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Utilisateur", inversedBy="affiches")
     */
    private $auteur;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="affiche", orphanRemoval=true)
     */
    private $commentaires;

    /**
     * @ORM\Column(type="datetime")
     */
    private $CreateAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updateAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Departement", inversedBy="affiches")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AfficheFile", mappedBy="affiche")
     */
    private $fichiers;

    public function __construct()
    {
        $this->setCreateAt(new \DateTime);
        $this->setUpdateAt(new \DateTime);
        $this->likes = new ArrayCollection();
        $this->commentaires = new ArrayCollection();
        $this->fichiers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDetail(): ?string
    {
        return $this->detail;
    }

    public function setDetail(?string $detail): self
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * @return Collection|Utilisateur[]
     */
    public function getLikes(): Collection
    {
        return $this->likes;
    }

    public function addLike(Utilisateur $like): self
    {
        if (!$this->likes->contains($like)) {
            $this->likes[] = $like;
            $like->setLiker($this);
        }

        return $this;
    }

    public function removeLike(Utilisateur $like): self
    {
        if ($this->likes->contains($like)) {
            $this->likes->removeElement($like);
            // set the owning side to null (unless already changed)
            if ($like->getLiker() === $this) {
                $like->setLiker(null);
            }
        }

        return $this;
    }

    public function getAuteur(): ?Utilisateur
    {
        return $this->auteur;
    }

    public function setAuteur(?Utilisateur $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    /**
     * @return Collection|Comment[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Comment $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setAffiche($this);
        }

        return $this;
    }

    public function removeCommentaire(Comment $commentaire): self
    {
        if ($this->commentaires->contains($commentaire)) {
            $this->commentaires->removeElement($commentaire);
            // set the owning side to null (unless already changed)
            if ($commentaire->getAffiche() === $this) {
                $commentaire->setAffiche(null);
            }
        }

        return $this;
    }

    public function getCreateAt(): ?\DateTimeInterface
    {
        return $this->CreateAt;
    }

    public function setCreateAt(\DateTimeInterface $CreateAt): self
    {
        $this->CreateAt = $CreateAt;

        return $this;
    }

    public function getUpdateAt(): ?\DateTimeInterface
    {
        return $this->updateAt;
    }

    public function setUpdateAt(\DateTimeInterface $updateAt): self
    {
        $this->updateAt = $updateAt;

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

    /**
     * @return Collection|AfficheFile[]
     */
    public function getFichiers(): Collection
    {
        return $this->fichiers;
    }

    public function addFichier(AfficheFile $fichier): self
    {
        if (!$this->fichiers->contains($fichier)) {
            $this->fichiers[] = $fichier;
            $fichier->setAffiche($this);
        }

        return $this;
    }

    public function removeFichier(AfficheFile $fichier): self
    {
        if ($this->fichiers->contains($fichier)) {
            $this->fichiers->removeElement($fichier);
            // set the owning side to null (unless already changed)
            if ($fichier->getAffiche() === $this) {
                $fichier->setAffiche(null);
            }
        }

        return $this;
    }
}
