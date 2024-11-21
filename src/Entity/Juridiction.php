<?php

namespace App\Entity;

use App\Repository\JuridictionRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

use Doctrine\Common\Collections\ArrayCollection;


/**
 * @ORM\Entity(repositoryClass=JuridictionRepository::class)
 */
class Juridiction
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
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Lieu;

    /**
     * @ORM\OneToMany(mappedBy="juridiction", targetEntity=Chambre::class, cascade={"persist", "remove"})
     */
    private $chambres;

    public function __construct()
    {
        $this->chambres = new ArrayCollection();
    }

    
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Ville;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getLieu(): ?string
    {
        return $this->Lieu;
    }

    public function setLieu(string $Lieu): self
    {
        $this->Lieu = $Lieu;

        return $this;
    }

    

    public function getVille(): ?string
    {
        return $this->Ville;
    }

    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }


    public function __toString(): string
    {
        return $this->Titre ; 
    }

    public function getChambres(): Collection
    {
        return $this->chambres;
    }

    public function addChambre(Chambre $chambre): self
    {
        if (!$this->chambres->contains($chambre)) {
            $this->chambres[] = $chambre;
            $chambre->setJuridiction($this);
        }
        return $this;
    }
    public function removeChambre(Chambre $chambre): self
    {
        if ($this->chambres->removeElement($chambre)) {
            if ($chambre->getJuridiction() === $this) {
                $chambre->setJuridiction(null);
            }
        }
        return $this;
    }
}
