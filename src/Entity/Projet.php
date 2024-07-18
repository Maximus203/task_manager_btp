<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_nom_projet')]
    #[Assert\Length(min: 10, minMessage: 'nom_projet_min_length', max: 255, maxMessage: 'nom_projet_max_length')]
    #[Assert\Type(type: 'string', message: 'nom_projet_string')]
    #[Assert\Unique(message: 'nom_projet_unique')]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_description_projet')]
    #[Assert\Length(min: 10, minMessage: 'description_projet_min_length', max: 255, maxMessage: 'description_projet_max_length')]
    #[Assert\Type(type: 'string', message: 'description_projet_string')]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'not_blank_date_debut_projet')]
    #[Assert\Date(message: 'date_debut_projet_date')]
    private ?\DateTimeInterface $date_debut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Assert\NotBlank(message: 'not_blank_date_fin_projet')]
    #[Assert\Date(message: 'date_fin_projet_date')]
    #[Assert\GreaterThanOrEqual('date_debut', message: 'date_fin_projet_greater_than_date_debut')]
    private ?\DateTimeInterface $date_fin = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'not_blank_budget_projet')]
    #[Assert\Positive(message: 'budget_projet_positive')]
    #[Assert\Type(type: 'float')]
    private ?float $budget = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_status_projet')]
    #[Assert\Choice(['to_do', 'in_progress', 'on_hold', 'under_review', 'failed', 'cancelled', 'deferred', 'ouverdue', 'completed'], message: 'status_invalid_projet')]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->date_debut;
    }

    public function setDateDebut(\DateTimeInterface $date_debut): static
    {
        $this->date_debut = $date_debut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->date_fin;
    }

    public function setDateFin(\DateTimeInterface $date_fin): static
    {
        $this->date_fin = $date_fin;

        return $this;
    }

    public function getBudget(): ?float
    {
        return $this->budget;
    }

    public function setBudget(float $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
