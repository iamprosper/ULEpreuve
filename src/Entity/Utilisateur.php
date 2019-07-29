<?php

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UtilisateurRepository")
 * @ORM\Table(name="fos_user")
 */
class Utilisateur implements UserInterface, \Serializable
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
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $username;

    /**
     * @ORM\Column(type="date")
     */
    private $dateNaissance;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime")
     */
    private $uptodateAt;


    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8",minMessage="La longueur minimale du mot de passe doit etre superieur ou egale a 8 caracteres")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\EqualTo(propertyPath="password", message="Les mots de passe se different")
     */
    private $confirm_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     */
    private $email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sexe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="auteur")
     */
    private $comments;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Affiche", inversedBy="likes")
     */
    private $liker;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Affiche", mappedBy="auteur")
     */
    private $affiches;

    public function __construct()
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUptodateAt(new \DateTime);
        $this->comments = new ArrayCollection();
        $this->affiches = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUptodateAt(): ?\DateTimeInterface
    {
        return $this->uptodateAt;
    }

    public function setUptodateAt(\DateTimeInterface $uptodateAt): self
    {
        $this->uptodateAt = $uptodateAt;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function setConfirmPassword(string $confirm_password): self
    {
        $this->confirm_password= $confirm_password;

        return $this;
    }
    public function getConfirmPassword(): ?string
    {
        return $this->confirm_password;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getSexe(): ?bool
    {
        return $this->sexe;
    }

    public function setSexe(bool $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }
    public function eraseCredentials(){}
    
    public function getSalt(){}
    
    public function getRoles(){
        return ['ROLE_USER'];
    }
    
    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->username,
            $this->nom,
            $this->prenom,
            $this->password,
            $this->confirm_password,
            $this->dateNaissance,
            // see section on salt below
            // $this->salt,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->username,
            $this->nom,
            $this->prenom,
            $this->password,
            $this->confirm_password,
            $this->dateNaissance,
            // see section on salt below
            // $this->salt
        ) = unserialize($serialized);
    }

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setAuteur($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getAuteur() === $this) {
                $comment->setAuteur(null);
            }
        }

        return $this;
    }

    public function getLiker(): ?Affiche
    {
        return $this->liker;
    }

    public function setLiker(?Affiche $liker): self
    {
        $this->liker = $liker;

        return $this;
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
            $affich->setAuteur($this);
        }

        return $this;
    }

    public function removeAffich(Affiche $affich): self
    {
        if ($this->affiches->contains($affich)) {
            $this->affiches->removeElement($affich);
            // set the owning side to null (unless already changed)
            if ($affich->getAuteur() === $this) {
                $affich->setAuteur(null);
            }
        }

        return $this;
    }
}


