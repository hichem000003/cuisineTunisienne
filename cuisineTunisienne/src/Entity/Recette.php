<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecetteRepository::class)
 */
class Recette
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
    private $nomRecette;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempsCuisson;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tempsPreparation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $video;

    /**
     * @ORM\Column(type="integer")
     */
    private $nbPersonnes;

    /**
     * @ORM\Column(type="integer")
     */
    private $niveauDifficulte;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $refRecette;

    /**
     * @ORM\OneToMany(targetEntity=Etape::class, mappedBy="recettes")
     */
    private $ref_rect_etape;

    /**
     * @ORM\ManyToOne(targetEntity=Categorie::class, inversedBy="ref_rect_categorie")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categories;

    public function __construct()
    {
        $this->ref_rect_etape = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    /*public function setId(integer $id): self
    {
        $this->id = $id;
    }*/

    public function getNomRecette(): ?string
    {
        return $this->nomRecette;
    }

    public function setNomRecette(string $nomRecette): self
    {
        $this->nomRecette = $nomRecette;

        return $this;
    }

    public function getTempsCuisson():  ?string
    {
        return $this->tempsCuisson;
    }

    public function setTempsCuisson(?string $tempsCuisson): self
    {
        $this->tempsCuisson = $tempsCuisson;

        return $this;
    }

    public function getTempsPreparation():  ?string
    {
        return $this->tempsPreparation;
    }

    public function setTempsPreparation(?string $tempsPreparation): self
    {
        $this->tempsPreparation = $tempsPreparation;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getVideo(): ?string
    {
        return $this->video;
    }

    public function setVideo(?string $video): self
    {
        $this->video = $video;

        return $this;
    }

    public function getNbPersonnes(): ?int
    {
        return $this->nbPersonnes;
    }

    public function setNbPersonnes(int $nbPersonnes): self
    {
        $this->nbPersonnes = $nbPersonnes;

        return $this;
    }

    public function getNiveauDifficulte(): ?int
    {
        return $this->niveauDifficulte;
    }

    public function setNiveauDifficulte(int $niveauDifficulte): self
    {
        $this->niveauDifficulte = $niveauDifficulte;

        return $this;
    }

    public function getRefRecette(): ?string
    {
        return $this->refRecette;
    }

    public function setRefRecette(string $refRecette): self
    {
        $this->refRecette = $refRecette;

        return $this;
    }

    /**
     * @return Collection|Etape[]
     */
    public function getRefRectEtape(): Collection
    {
        return $this->ref_rect_etape;
    }

    public function addRefRectEtape(Etape $refRectEtape): self
    {
        if (!$this->ref_rect_etape->contains($refRectEtape)) {
            $this->ref_rect_etape[] = $refRectEtape;
            $refRectEtape->setRecettes($this);
        }

        return $this;
    }

    public function removeRefRectEtape(Etape $refRectEtape): self
    {
        if ($this->ref_rect_etape->removeElement($refRectEtape)) {
            // set the owning side to null (unless already changed)
            if ($refRectEtape->getRecettes() === $this) {
                $refRectEtape->setRecettes(null);
            }
        }

        return $this;
    }

    public function getCategories(): ?Categorie
    {
        return $this->categories;
    }

    public function setCategories(?Categorie $categories): self
    {
        $this->categories = $categories;

        return $this;
    }
}
