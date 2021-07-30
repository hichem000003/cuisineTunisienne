<?php

namespace App\Entity;

use App\Repository\AbonnementRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;



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
     * @ORM\Column(type="string", nullable=true)
     */
    private $dateAbonnement;

    /**
     * @ORM\ManyToOne(targetEntity=Chef::class, inversedBy="abonnements")
	 * @Serializer\Exclude()
     */
    private $chef;

    /**
     * @ORM\ManyToOne(targetEntity=Membre::class, inversedBy="abonnements")
	 * @Serializer\Exclude()
     */
    private $membre;

    public function getId(): ?int
    {
        return $this->id;
    }
	
	public function setId(?int $id): self
    {
        $this->id = $id;

        return $this;
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

    public function getDateAbonnement(): ?string
    {
        return $this->dateAbonnement;
    }

    public function setDateAbonnement(?string $dateAbonnement): self
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
	
	/**
     * @Serializer\VirtualProperty()
	 * @Serializer\SerializedName("chef")
     */
	public function getIdOfChef()
	{
		return $this->getChef()->getId();
	}
	
	/**
     * @Serializer\VirtualProperty()
	 * @Serializer\SerializedName("membre")
     */
	public function getIdOfMembre()
	{
		$id = $this->getMembre();
		if($id == null){
			return null;
		}
		return $id->getId();
	}
}
