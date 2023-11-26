<?php

namespace App\Entity;

use App\Repository\ClasseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClasseRepository::class)]
class Classe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $designationClasse = null;

    #[ORM\Column]
    private ?int $niveauClasse = null;

    #[ORM\ManyToOne(inversedBy: 'classes')]
    private ?Filiere $filiere = null;

    #[ORM\OneToMany(mappedBy: 'classe', targetEntity: Etudiant::class)]
    private Collection $etudiants;

    #[ORM\ManyToMany(targetEntity: Enseignant::class, mappedBy: 'classe')]
    private Collection $enseignants;

    public function __construct()
    {
        $this->etudiants = new ArrayCollection();
        $this->enseignants = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDesignationClasse(): ?string
    {
        return $this->designationClasse;
    }

    public function setDesignationClasse(string $designationClasse): static
    {
        $this->designationClasse = $designationClasse;

        return $this;
    }

    public function getNiveauClasse(): ?int
    {
        return $this->niveauClasse;
    }

    public function setNiveauClasse(int $niveauClasse): static
    {
        $this->niveauClasse = $niveauClasse;

        return $this;
    }

    public function getFiliere(): ?Filiere
    {
        return $this->filiere;
    }

    public function setFiliere(?Filiere $filiere): static
    {
        $this->filiere = $filiere;

        return $this;
    }

    /**
     * @return Collection<int, Etudiant>
     */
    public function getEtudiants(): Collection
    {
        return $this->etudiants;
    }

    public function addEtudiant(Etudiant $etudiant): static
    {
        if (!$this->etudiants->contains($etudiant)) {
            $this->etudiants->add($etudiant);
            $etudiant->setClasse($this);
        }

        return $this;
    }

    public function removeEtudiant(Etudiant $etudiant): static
    {
        if ($this->etudiants->removeElement($etudiant)) {
            // set the owning side to null (unless already changed)
            if ($etudiant->getClasse() === $this) {
                $etudiant->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Enseignant>
     */
    public function getEnseignants(): Collection
    {
        return $this->enseignants;
    }

    public function addEnseignant(Enseignant $enseignant): static
    {
        if (!$this->enseignants->contains($enseignant)) {
            $this->enseignants->add($enseignant);
            $enseignant->addClasse($this);
        }

        return $this;
    }

    public function removeEnseignant(Enseignant $enseignant): static
    {
        if ($this->enseignants->removeElement($enseignant)) {
            $enseignant->removeClasse($this);
        }

        return $this;
    }
}
