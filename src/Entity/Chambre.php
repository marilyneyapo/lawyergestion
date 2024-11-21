<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
/** 
* @ORM\Entity
*/
class Chambre
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
    private  $nom;
    /**
    * @ORM\Column(type="json")
    */
    private $greffiers = [];

    /** 
    * @ORM\Column(type="string", length=255)
    */
    private  $president;
    /** 
    * @ORM\ManyToOne(targetEntity=Juridiction::class, inversedBy="chambres")
    * @ORM\JoinColumn(nullable=false)
    */
    private  $juridiction = null;

    // Getters and Setters

    public function getId(): int
    {
        return $this->id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getGreffiers(): array
    {
        return $this->greffiers;
    }

// Setter
    public function setGreffiers(array $greffiers): self
    {
        $this->greffiers = $greffiers;
        return $this;
    }
    public function getPresident(): string
    {
        return $this->president;
    }

    public function setPresident(string $president): self
    {
        $this->president = $president;
        return $this;
    }

    public function getJuridiction(): ?Juridiction
    {
        return $this->juridiction;
    }

    public function setJuridiction(?Juridiction $juridiction): self
    {
        $this->juridiction = $juridiction;
        return $this;
    }

    public function __toString(): string
    {
        return $this->nom;
    }
}
