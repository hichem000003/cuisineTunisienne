<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EvenementRepository::class)
 */
class Evenement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
     private $nomEvenement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionEvenement;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nbMaxParticipant;

    /**
     * @ORM\Column(type="date")
     */
    private $dateDebutEvenment;

    /**
     * @ORM\Column(type="date")
     */
    private $dateFinEvenement;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $prix;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $emplacement;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $statut;

    /**
     * @ORM\OneToMany(targetEntity=Participation::class, mappedBy="Evenement", orphanRemoval=true)
     */
    private $participations;

    public function __construct()
    {
        $this->participations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvenement(): ?string
    {
        return $this->nomEvenement;
    }

    public function setNomEvenement(string $nomEvenement): self
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    public function getDescriptionEvenement(): ?string
    {
        return $this->descriptionEvenement;
    }

    public function setDescriptionEvenement(?string $descriptionEvenement): self
    {
        $this->descriptionEvenement = $descriptionEvenement;

        return $this;
    }

    public function getNbMaxParticipant(): ?int
    {
        return $this->nbMaxParticipant;
    }

    public function setNbMaxParticipant(?int $nbMaxParticipant): self
    {
        $this->nbMaxParticipant = $nbMaxParticipant;

        return $this;
    }

    public function getDateDebutEvenment(): ?\DateTimeInterface
    {
        return $this->dateDebutEvenment;
    }

    public function setDateDebutEvenment(\DateTimeInterface $dateDebutEvenment): self
    {
        $this->dateDebutEvenment = $dateDebutEvenment;

        return $this;
    }

    public function getDateFinEvenement(): ?\DateTimeInterface
    {
        return $this->dateFinEvenement;
    }

    public function setDateFinEvenement(\DateTimeInterface $dateFinEvenement): self
    {
        $this->dateFinEvenement = $dateFinEvenement;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getEmplacement(): ?string
    {
        return $this->emplacement;
    }

    public function setEmplacement(string $emplacement): self
    {
        $this->emplacement = $emplacement;

        return $this;
    }

    public function getStatut(): ?string
    {
        return $this->statut;
    }

    public function setStatut(?string $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    /**
     * @return Collection|Participation[]
     */
    public function getParticipations(): Collection
    {
        return $this->participations;
    }

    public function addParticipation(Participation $participation): self
    {
        if (!$this->participations->contains($participation)) {
            $this->participations[] = $participation;
            $participation->setEvenement($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): self
    {
        if ($this->participations->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getEvenement() === $this) {
                $participation->setEvenement(null);
            }
        }

        return $this;
    }
}
