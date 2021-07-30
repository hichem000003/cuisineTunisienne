<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CategorieRepository::class)
 */
class Categorie
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
    private $refCategorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nomCategorie;

    /**
     * @ORM\OneToMany(targetEntity=Recette::class, mappedBy="categories")
     */
    private $ref_rect_categorie;

    public function __construct()
    {
        $this->ref_rect_categorie = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRefCategorie(): ?string
    {
        return $this->refCategorie;
    }

    public function setRefCategorie(string $refCategorie): self
    {
        $this->refCategorie = $refCategorie;

        return $this;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): self
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection|Recette[]
     */
    public function getRefRectCategorie(): Collection
    {
        return $this->ref_rect_categorie;
    }

    public function addRefRectCategorie(Recette $refRectCategorie): self
    {
        if (!$this->ref_rect_categorie->contains($refRectCategorie)) {
            $this->ref_rect_categorie[] = $refRectCategorie;
            $refRectCategorie->setCategories($this);
        }

        return $this;
    }

    public function removeRefRectCategorie(Recette $refRectCategorie): self
    {
        if ($this->ref_rect_categorie->removeElement($refRectCategorie)) {
            // set the owning side to null (unless already changed)
            if ($refRectCategorie->getCategories() === $this) {
                $refRectCategorie->setCategories(null);
            }
        }

        return $this;
    }
}
