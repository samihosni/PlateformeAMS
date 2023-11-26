<?php

namespace App\Entity;

use App\Repository\EnseignantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EnseignantRepository::class)]
class Enseignant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomEnseignant = null;

    #[ORM\Column(length: 20)]
    private ?string $prenomEnseignant = null;

    #[ORM\Column(length: 30)]
    private ?string $adresseMailEnseignant = null;

    #[ORM\Column]
    private ?int $numTel = null;

    #[ORM\ManyToOne(inversedBy: 'enseignants')]
    private ?Cours $cours = null;

    #[ORM\OneToMany(mappedBy: 'enseignant', targetEntity: Note::class)]
    private Collection $notes;

    #[ORM\ManyToMany(targetEntity: Classe::class, inversedBy: 'enseignants')]
    private Collection $classe;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->classe = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEnseignant(): ?string
    {
        return $this->nomEnseignant;
    }

    public function setNomEnseignant(string $nomEnseignant): static
    {
        $this->nomEnseignant = $nomEnseignant;

        return $this;
    }

    public function getPrenomEnseignant(): ?string
    {
        return $this->prenomEnseignant;
    }

    public function setPrenomEnseignant(string $prenomEnseignant): static
    {
        $this->prenomEnseignant = $prenomEnseignant;

        return $this;
    }

    public function getAdresseMailEnseignant(): ?string
    {
        return $this->adresseMailEnseignant;
    }

    public function setAdresseMailEnseignant(string $adresseMailEnseignant): static
    {
        $this->adresseMailEnseignant = $adresseMailEnseignant;

        return $this;
    }

    public function getNumTel(): ?int
    {
        return $this->numTel;
    }

    public function setNumTel(int $numTel): static
    {
        $this->numTel = $numTel;

        return $this;
    }

    public function getCours(): ?Cours
    {
        return $this->cours;
    }

    public function setCours(?Cours $cours): static
    {
        $this->cours = $cours;

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
            $note->setEnseignant($this);
        }

        return $this;
    }

    public function removeNote(Note $note): static
    {
        if ($this->notes->removeElement($note)) {
            // set the owning side to null (unless already changed)
            if ($note->getEnseignant() === $this) {
                $note->setEnseignant(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Classe>
     */
    public function getClasse(): Collection
    {
        return $this->classe;
    }

    public function addClasse(Classe $classe): static
    {
        if (!$this->classe->contains($classe)) {
            $this->classe->add($classe);
        }

        return $this;
    }

    public function removeClasse(Classe $classe): static
    {
        $this->classe->removeElement($classe);

        return $this;
    }
}
