<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AbonnementRepository::class)
 */
class Abonnement
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numAbonnement;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateAbonnement;

    /**
     * @ORM\ManyToOne(targetEntity=Chef::class, inversedBy="abonnements")
     */
    private $chef;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="abonnements")
     */
    private $membre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAbonnement(): ?int
    {
        return $this->numAbonnement;
    }

    public function setNumAbonnement(?int $numAbonnement): self
    {
        $this->numAbonnement = $numAbonnement;

        return $this;
    }

    public function getDateAbonnement(): ?\DateTimeInterface
    {
        return $this->dateAbonnement;
    }

    public function setDateAbonnement(?\DateTimeInterface $dateAbonnement): self
    {
        $this->dateAbonnement = $dateAbonnement;

        return $this;
    }

    public function getChef(): ?Chef
    {
        return $this->chef;
    }

    public function setChef(?Chef $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

    public function getMembre(): ?Membre
    {
        return $this->membre;
    }

    public function setMembre(?Membre $membre): self
    {
        $this->membre = $membre;

        return $this;
    }
}
