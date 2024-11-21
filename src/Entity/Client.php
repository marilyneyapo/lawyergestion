<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client extends User
{

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    


    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $raisonso;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typecli;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profil;


    
    /**
     * @ORM\OneToOne(targetEntity=Dossier::class, inversedBy="client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;
    

    /** 
    * @ORM\OneToMany(mappedBy="client", targetEntity=Audience::class)
    */
    private $audiences;

    /**
     * @ORM\ManyToOne(targetEntity=Adversaire::class, inversedBy="client")
     */
    private $adversaire; 

    public function __construct()
    {
        $this->audiences = new ArrayCollection();


    }

    

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }
    

    public function getAdversaire(): ?Adversaire
    {
        return $this->adversaire;
    }

    public function setAdversaire(?Adversaire $adversaire): self
    {
        $this->adversaire = $adversaire;

        return $this;
    }

    public function getRaisonso(): ?string
    {
        return $this->raisonso;
    }

    public function setRaisonso(?string $raisonso): self
    {
        $this->raisonso = $raisonso;

        return $this;
    }


    

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

   

    public function getProfil(): ?string
    {
        return $this->profil;
    }

    public function setProfil(?string $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    
    
    
    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }
    
    public function setDossier(?Dossier $dossier): self 
    {
        $this->dossier = $dossier;

        return $this;
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
