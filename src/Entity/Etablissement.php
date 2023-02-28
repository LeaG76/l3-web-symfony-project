<?php

namespace App\Entity;

use App\Repository\EtablissementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=EtablissementRepository::class)
 */
class Etablissement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Le nom est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @Assert\NotBlank(message="La nature est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $nature;

    /**
     * @Assert\NotBlank(message="Le secteur est obligatoire")
     * 
     * @ORM\Column(type="string", length=255, columnDefinition="enum('Public', 'Privé')")
     */
    private $secteur;

    /**
     * @Assert\NotBlank(message="La longitude est obligatoire")
     * 
     * @ORM\Column(type="float")
     */
    private $longitude;

    /**
     * @Assert\NotBlank(message="La latitude est obligatoire")
     * 
     * @ORM\Column(type="float")
     */
    private $latitude;

    /**
     * @Assert\NotBlank(message="L'adresse est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @Assert\NotBlank(message="Le département est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $departement;

    /**
     * @Assert\NotBlank(message="La commune est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $commune;

    /**
     * @Assert\NotBlank(message="La region est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $region;

    /**
     * @Assert\NotBlank(message="L'académie est obligatoire")
     * 
     * @ORM\Column(type="string", length=255)
     */
    private $academie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $date_ouverture;

    /**
     * @ORM\OneToMany(targetEntity=Commentaire::class, mappedBy="etablissement")
     */
    private $commentaires;

    public function __construct()
    {
        $this->commentaires = new ArrayCollection();
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

    public function getNature(): ?string
    {
        return $this->nature;
    }

    public function setNature(string $nature): self
    {
        $this->nature = $nature;

        return $this;
    }

    public function getSecteur(): ?string
    {
        return $this->secteur;
    }

    public function setSecteur(string $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getDepartement(): ?string
    {
        return $this->departement;
    }

    public function setDepartement(string $departement): self
    {
        $this->departement = $departement;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getRegion(): ?string
    {
        return $this->region;
    }

    public function setRegion(string $region): self
    {
        $this->region = $region;

        return $this;
    }

    public function getAcademie(): ?string
    {
        return $this->academie;
    }

    public function setAcademie(string $academie): self
    {
        $this->academie = $academie;

        return $this;
    }

    public function getDateOuverture(): ?string
    {
        return $this->date_ouverture;
    }

    public function setDateOuverture(string $date_ouverture): self
    {
        $this->date_ouverture = $date_ouverture;

        return $this;
    }

    /**
     * @return Collection|Commentaire[]
     */
    public function getCommentaires(): Collection
    {
        return $this->commentaires;
    }

    public function addCommentaire(Commentaire $commentaire): self
    {
        if (!$this->commentaires->contains($commentaire)) {
            $this->commentaires[] = $commentaire;
            $commentaire->setEtablissement($this);
        }

        return $this;
    }

    public function removeCommentaire(Commentaire $commentaire): self
    {
        if ($this->commentaires->removeElement($commentaire)) {
            // set the owning side to null (unless already changed)
            if ($commentaire->getEtablissement() === $this) {
                $commentaire->setEtablissement(null);
            }
        }

        return $this;
    }
}
