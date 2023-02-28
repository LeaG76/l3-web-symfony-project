<?php

namespace App\Entity;

use App\Repository\CommentaireRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=CommentaireRepository::class)
 */
class Commentaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom de l'auteur est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $nom_auteur;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @Assert\NotBlank(message="La note est obligatoire")
     * 
     * @ORM\Column(type="integer", columnDefinition="enum('1','2','3','4','5')")
     */
    private $note;

    /**
     * @Assert\NotBlank(message="Le texte du commentaire est obligatoire")
     * 
     * @ORM\Column(type="string", length=1000)
     */
    private $texte;

    /**
     * @ORM\ManyToOne(targetEntity=Etablissement::class, inversedBy="commentaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $etablissement;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomAuteur(): ?string
    {
        return $this->nom_auteur;
    }

    public function setNomAuteur(string $nom_auteur): self
    {
        $this->nom_auteur = $nom_auteur;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function getTexte(): ?string
    {
        return $this->texte;
    }

    public function setTexte(string $texte): self
    {
        $this->texte = $texte;

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
}
