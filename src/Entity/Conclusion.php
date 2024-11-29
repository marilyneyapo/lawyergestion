<?php


namespace App\Entity;

use App\Repository\ConclusionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ConclusionRepository::class)
 */
class Conclusion
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Dossier", inversedBy="conclusions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="boolean")
     */
    private $deposee = false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(Dossier $dossier): self
    {
        $this->dossier = $dossier;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(?\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }
    
    public function getDescription(): ?string
    {
        return $this->description;
    } 
    public function setDescription(string $description): self
    {
        $this->description->$description;
        return $this;
    }

    public function isDeposee(): bool
    {
        return $this->deposee;
    }

    public function setDeposee(bool $deposee): self
    {
        $this->deposee = $deposee;
        if ($deposee) {
            $this->dateDepot = new \DateTime();  // Si la conclusion est déposée, on définit la date actuelle
        } else {
            $this->dateDepot = null;  // Sinon, on remet la date à null
        }

        return $this;
    }
}

