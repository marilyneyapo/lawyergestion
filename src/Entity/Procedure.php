<?php

namespace App\Entity;

use App\Repository\ProcedureRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProcedureRepository::class)
 * @ORM\Table(name="procedures")

 */
class Procedure
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="procedures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    // Getter and setter for dossier
    public function getDossier(): ?Dossier
    {
        return $this->dossier;
    }

    public function setDossier(?Dossier $dossier): self
    {
        $this->dossier = $dossier;
        return $this;
    }
    /**
     * @ORM\Column(type="datetime")
     */
    private $date;
    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }


    /**
     * @ORM\Column(type="string")
     */

    private $type;

    public function getType(): ?string{
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type->$type;
        return $this;
    }

    /**
     * @ORM\Column(type="string")
     */
    private $description;

    public function getDescription(): ?string
    {
        return $this->description;
    } 
    public function setDescription(string $description): self
    {
        $this->description->$description;
        return $this;
    }
}
