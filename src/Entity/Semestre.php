<?php

namespace App\Entity;

use App\Repository\SemestreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemestreRepository::class)]
class Semestre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numSemestre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutSemestre = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinSemestre = null;

    #[ORM\ManyToOne(inversedBy: 'semestres')]
    private ?Session $session = null;

    #[ORM\OneToMany(mappedBy: 'semestre', targetEntity: Module::class)]
    private Collection $modules;

    public function __construct()
    {
        $this->modules = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumSemestre(): ?int
    {
        return $this->numSemestre;
    }

    public function setNumSemestre(int $numSemestre): static
    {
        $this->numSemestre = $numSemestre;

        return $this;
    }

    public function getDateDebutSemestre(): ?\DateTimeInterface
    {
        return $this->dateDebutSemestre;
    }

    public function setDateDebutSemestre(\DateTimeInterface $dateDebutSemestre): static
    {
        $this->dateDebutSemestre = $dateDebutSemestre;

        return $this;
    }

    public function getDateFinSemestre(): ?\DateTimeInterface
    {
        return $this->dateFinSemestre;
    }

    public function setDateFinSemestre(\DateTimeInterface $dateFinSemestre): static
    {
        $this->dateFinSemestre = $dateFinSemestre;

        return $this;
    }

    public function getSession(): ?Session
    {
        return $this->session;
    }

    public function setSession(?Session $session): static
    {
        $this->session = $session;

        return $this;
    }

    /**
     * @return Collection<int, Module>
     */
    public function getModules(): Collection
    {
        return $this->modules;
    }

    public function addModule(Module $module): static
    {
        if (!$this->modules->contains($module)) {
            $this->modules->add($module);
            $module->setSemestre($this);
        }

        return $this;
    }

    public function removeModule(Module $module): static
    {
        if ($this->modules->removeElement($module)) {
            // set the owning side to null (unless already changed)
            if ($module->getSemestre() === $this) {
                $module->setSemestre(null);
            }
        }

        return $this;
    }
}
