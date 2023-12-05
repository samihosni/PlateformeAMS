<?php

namespace App\Entity;

use App\Repository\SessionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SessionRepository::class)]
class Session
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nomSession = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebSession = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinSession = null;

    #[ORM\OneToMany(mappedBy: 'session', targetEntity: Semestre::class)]
    private Collection $semestres;

    public function __construct()
    {
        $this->semestres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomSession(): ?string
    {
        return $this->nomSession;
    }

    public function setNomSession(string $nomSession): static
    {
        $this->nomSession = $nomSession;

        return $this;
    }

    public function getDateDebSession(): ?\DateTimeInterface
    {
        return $this->dateDebSession;
    }

    public function setDateDebSession(\DateTimeInterface $dateDebSession): static
    {
        $this->dateDebSession = $dateDebSession;

        return $this;
    }

    public function getDateFinSession(): ?\DateTimeInterface
    {
        return $this->dateFinSession;
    }

    public function setDateFinSession(\DateTimeInterface $dateFinSession): static
    {
        $this->dateFinSession = $dateFinSession;

        return $this;
    }

    /**
     * @return Collection<int, Semestre>
     */
    public function getSemestres(): Collection
    {
        return $this->semestres;
    }

    public function addSemestre(Semestre $semestre): static
    {
        if (!$this->semestres->contains($semestre)) {
            $this->semestres->add($semestre);
            $semestre->setSession($this);
        }

        return $this;
    }

    public function removeSemestre(Semestre $semestre): static
    {
        if ($this->semestres->removeElement($semestre)) {
            // set the owning side to null (unless already changed)
            if ($semestre->getSession() === $this) {
                $semestre->setSession(null);
            }
        }

        return $this;
    }
    public function __toString(): string
    {
        return $this->nomSession;

    }
}
