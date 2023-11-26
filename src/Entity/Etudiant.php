<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomEtudiant = null;

    #[ORM\Column(length: 20)]
    private ?string $prenomEtudiant = null;

    #[ORM\Column(length: 30)]
    private ?string $adresseMail = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column]
    private ?int $numTelEtudiant = null;

    #[ORM\ManyToOne(inversedBy: 'etudiants')]
    private ?Classe $classe = null;

    #[ORM\OneToMany(mappedBy: 'etudiant', targetEntity: Note::class)]
    private Collection $notes;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nomEtudiant;
    }

    public function setNomEtudiant(string $nomEtudiant): static
    {
        $this->nomEtudiant = $nomEtudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenomEtudiant;
    }

    public function setPrenomEtudiant(string $prenomEtudiant): static
    {
        $this->prenomEtudiant = $prenomEtudiant;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->adresseMail;
    }

    public function setAdresseMail(string $adresseMail): static
    {
        $this->adresseMail = $adresseMail;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): static
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumTelEtudiant(): ?int
    {
        return $this->numTelEtudiant;
    }

    public function setNumTelEtudiant(int $numTelEtudiant): static
    {
        $this->numTelEtudiant = $numTelEtudiant;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->classe;
    }

    public function setClasse(?Classe $classe): static
    {
        $this->classe = $classe;

        return $this;
    }

    /**
     * @return Collection<int, Note>
     */
    public function getNotes(): Collection
    {
        return $this->notes;
    }

    public function addNote(Note $note): static
    {
        if (!$this->notes->contains($note)) {
            $this->notes->add($note);
            $note->setEtudiant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): static
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEtudiant() === $this) {
                $note->setEtudiant(null);
            }
        }

        return $this;
    }
}
