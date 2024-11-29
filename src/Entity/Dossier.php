<?php

namespace App\Entity;

use App\Repository\DossierRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Client;

/** 
 * @ORM\Entity(repositoryClass=DossierRepository::class)
 */
class Dossier
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="dossier", cascade={"persist", "remove"})
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Conclusion", mappedBy="dossier")
     */
    private $conclusions;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $numero;

    /**
     * @ORM\OneToMany(targetEntity="Procedure", mappedBy="dossier")
     */
    private $procedures;
    
    public function __construct() {
        $this->procedures = new ArrayCollection();
        $this->conclusions = new ArrayCollection();

    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        // Synchroniser le numéro du dossier avec la première lettre du nom du client
        if ($client) {
            $this->setNumeroDossier($client, $this->numero);
        }

        return $this;
    }

    /**
     * Définir le numéro du dossier basé sur la première lettre du nom du client et le numéro donné
     */
    public function setNumeroDossier(Client $client, string $numero): void
    {
        // La première lettre du nom du client
        $firstLetter = strtoupper(substr($client->getNom(), 0, 1)); // Première lettre en majuscule

        // Ajouter la première lettre au début du numéro fourni
        $this->numero = $firstLetter . $numero;
    }

    public function getConclusions(): ?Collection
    {
        return $this->conclusions;
    }

    public function setConclusion(?Conclusion $conclusions): self
    {
        $this->conclusions = $conclusions;

        return $this;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }
    
    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }
    public function getProcedures(): Collection
    {
        return $this->procedures;
    }

    // Setter for procedures (optional)
    public function setProcedures(Collection $procedures): self
    {
        $this->procedures = $procedures;
        return $this;
    }


    public function __toString(): string
    {
        return $this->numero ;
    }
}
