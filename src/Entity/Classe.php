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





    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'classe')]
    private Collection $users;

    public function __construct()
    {

        $this->users = new ArrayCollection();
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
    public function __toString()
    {
        return $this->niveauClasse . '-' . $this->filiere . '-'.$this->designationClasse;
    }















    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addClasse($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            $user->removeClasse($this);
        }

        return $this;
    }
}
