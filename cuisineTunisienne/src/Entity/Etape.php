<?php

namespace App\Entity;

use App\Repository\EtapeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EtapeRepository::class)
 */
class Etape
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numEtape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $descriptionEtape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $photoEtape;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoEtape;

    /**
     * @ORM\ManyToOne(targetEntity=Recette::class, inversedBy="ref_rect_etape")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recettes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumEtape(): ?int
    {
        return $this->numEtape;
    }

    public function setNumEtape(int $numEtape): self
    {
        $this->numEtape = $numEtape;

        return $this;
    }

    public function getDescriptionEtape(): ?string
    {
        return $this->descriptionEtape;
    }

    public function setDescriptionEtape(?string $descriptionEtape): self
    {
        $this->descriptionEtape = $descriptionEtape;

        return $this;
    }

    public function getPhotoEtape(): ?string
    {
        return $this->photoEtape;
    }

    public function setPhotoEtape(?string $photoEtape): self
    {
        $this->photoEtape = $photoEtape;

        return $this;
    }

    public function getVideoEtape(): ?string
    {
        return $this->videoEtape;
    }

    public function setVideoEtape(?string $videoEtape): self
    {
        $this->videoEtape = $videoEtape;

        return $this;
    }

    public function getRecettes(): ?Recette
    {
        return $this->recettes;
    }

    public function setRecettes(?Recette $recettes): self
    {
        $this->recettes = $recettes;

        return $this;
    }
}
