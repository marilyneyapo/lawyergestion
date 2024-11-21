<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AudienceRepository;

/**
 * @ORM\Entity(repositoryClass=AudienceRepository::class)
 */
class Audience
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Dossier::class, inversedBy="audiences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dossier;

    /**
     * @ORM\ManyToOne(targetEntity=Juridiction::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $juridiction;

    /**
     * @ORM\ManyToOne(targetEntity=Chambre::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $chambre;

    /**
     * @ORM\ManyToOne(targetEntity=Adversaire::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $adversaire;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $conseil;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\OneToMany(targetEntity=Renvoi::class, mappedBy="audience", cascade={"persist", "remove"})
     */
    private $renvois;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motif;

    public function __construct()
    {
        $this->renvois = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getClientNom(): ?string
    {
        return $this->dossier->getClient()->getNom();
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

    public function getChambre(): ?Chambre
    {
        return $this->chambre;
    }

    public function setChambre(?Chambre $chambre): self
    {
        $this->chambre = $chambre;

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

    public function getConseil(): ?string
    {
        return $this->conseil;
    }

    public function setConseil(string $conseil): self
    {
        $this->conseil = $conseil;

        return $this;
    }

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
     * @return Collection|Renvoi[]
     */
    public function getRenvois(): Collection
    {
        return $this->renvois;
    }

    public function addRenvoi(Renvoi $renvoi): self
    {
        if (!$this->renvois->contains($renvoi)) {
            $this->renvois[] = $renvoi;
            $renvoi->setAudience($this);
        }

        return $this;
    }

    public function removeRenvoi(Renvoi $renvoi): self
    {
        if ($this->renvois->removeElement($renvoi)) {
            // Set the owning side to null (unless already changed)
            if ($renvoi->getAudience() === $this) {
                $renvoi->setAudience(null);
            }
        }

        return $this;
    }
    public function getRenvoisAsString(): string
{
    if ($this->renvois->isEmpty()) {
        return 'Aucun renvoi';
    }

    // Convertir la collection en tableau avant de traiter chaque élément
    $renvoisArray = [];
    foreach ($this->renvois as $renvoi) {
        // Vérifiez que getDateRenvoi() retourne un objet DateTime
        $dateRenvoi = $renvoi->getDateRenvoi();
        $motif = $renvoi->getMotif();

        // Vérification si la date est bien un objet DateTime avant de la formater
        if ($dateRenvoi instanceof \DateTimeInterface) {
            $dateStr = $dateRenvoi->format('Y-m-d H:i:s');
        } else {
            $dateStr = 'Non défini';
        }

        // Vérification du motif (assurez-vous que c'est une chaîne)
        $motifStr = is_string($motif) ? $motif : 'Non défini';

        // Ajouter à l'array de résultats
        $renvoisArray[] = sprintf('Date: %s, Motif: %s', $dateStr, $motifStr);
    }

    // Retourner les renvois sous forme de chaîne, séparée par une virgule
    return implode(', ', $renvoisArray);
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

    public function getGreffier(): ?string
    {
        if ($this->chambre === null) {
            return null;
        }

        $greffiers = $this->chambre->getGreffiers();

        if (count($greffiers) === 2) {
            return $greffiers[0] . ' et ' . $greffiers[1];
        }

        return $greffiers[0] ?? null;
    }

    public function getPresident(): ?string
    {
        return $this->chambre->getPresident();
    }

    
}
