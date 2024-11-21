<?php

namespace App\Entity;

use App\Repository\RenvoisRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RenvoisRepository::class)
 */

class Renvoi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private  $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private  $dateRenvoi ;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private  $motif = null;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Audience", inversedBy="renvois")
     * @ORM\JoinColumn(nullable=false)
     */
    private  $audience ;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateRenvoi(): ?\DateTimeInterface
    {
        return $this->dateRenvoi;
    }

    public function setDateRenvoi(\DateTimeInterface $dateRenvoi): self
    {
        $this->dateRenvoi = $dateRenvoi;

        return $this;
    }

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

        return $this;
    }

    public function getAudience(): ?Audience
    {
        return $this->audience;
    }

    public function setAudience(?Audience $audience): self
    {
        $this->audience = $audience;

        return $this;
    }
}

