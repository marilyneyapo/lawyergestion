<?php

namespace App\Entity;

use App\Repository\ColabRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ColabRepository::class)
 */
class Colab extends User

{
    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Typecolab;

    /**
     * @ORM\ManyToMany(targetEntity=Dossier::class, mappedBy="colab")
     */
    private $dossiers;
    /** 
    * @ORM\OneToMany(mappedBy="colab", targetEntity=Client::class)
    */
    private $clients;
    /** 
    * @ORM\OneToMany(mappedBy="colab", targetEntity=Audience::class)
    */
    private $audiences;


    public function __construct()
    {
        $this->dossiers = new ArrayCollection();
        $this->clients = new ArrayCollection();
        $this->audiences = new ArrayCollection();
    }

    
    public function getTypecolab(): ?string
    {
        return $this->Typecolab;
    }

    public function setTypecolab(string $Typecolab): self
    {
        $this->Typecolab = $Typecolab;

        return $this;
    }

    /**
     * @return Collection<int, Dossier>
     */
    public function getDossiers(): Collection
    {
        return $this->dossiers;
    }

    public function getAudiences(): Collection
    {
        return $this->audiences;
    }

    public function setAudiences(?Audience $audiences): self
    {
        $this->audiences = $audiences;

        return $this;
    }

    
    
    

    
}
