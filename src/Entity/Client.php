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
    private $roles_client;


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
     * @ORM\OneToOne(targetEntity=Dossier::class, mappedBy="client")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossiers;
    

    /** 
    * @ORM\OneToMany(mappedBy="client", targetEntity=Audience::class)
    */
    private $audiences;

    /**
     * @ORM\OneToMany(mappedBy="client", targetEntity=Adversaire::class, cascade={"persist", "remove"})
     */
    private $adversaires; 

    public function __construct()
    {
        $this->audiences = new ArrayCollection();
        $this->adversaires = new ArrayCollection();
        $this->dossiers = new ArrayCollection();
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
    public function getRolesClient(): ?string
{
    return $this->roles_client;
}

/**
 * Set the value of roles_client
 *
 * @param string $roles_client
 * @return self
 */
public function setRolesClient(string $roles_client): self
{
    $this->roles_client = $roles_client;

    return $this;
}

    public function getAdversaires(): ?Collection
    {
        return $this->adversaires;
    }

    public function setAdversaires(?Adversaire $adversaires): self
    {
        $this->adversaires = $adversaires;

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

    
    
    
    public function getDossiers(): ?Collection
    {
        return $this->dossiers;
    }
    
    public function setDossiers(?Dossier $dossiers): self 
    {
        $this->dossiers = $dossiers;

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
