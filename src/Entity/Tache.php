<?php

namespace App\Entity;

use App\Repository\TacheRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: TacheRepository::class)]
class Tache
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_description_tache')]
    #[Assert\Length(min: 10, minMessage: 'description_tache_min_length', max: 255, maxMessage: 'description_tache_max_length')]
    #[Assert\Type(type: 'string', message: 'description_tache_string')]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Assert\NotBlank(message: 'not_blank_date_limite_tache')]
    #[Assert\Date(message: 'date_limite_tache_date')]
    private ?\DateTimeInterface $date_limite = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_status_tache')]
    #[Assert\Choice(['to_do', 'in_progress', 'on_hold', 'under_review', 'failed', 'cancelled', 'deferred', 'ouverdue', 'completed'], message: 'status_invalid_tache')]
    private ?string $status = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_nom_tache')]
    #[Assert\Length(min: 10, minMessage: 'nom_tache_min_length', max: 255, maxMessage: 'nom_tache_max_length')]
    #[Assert\Type(type: 'string', message: 'nom_tache_string')]
    private ?string $nom_tache = null;

    #[ORM\OneToOne(inversedBy: 'tachesValidees', cascade: ['persist', 'remove'])]
    private ?User $validateur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $date_validation = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Assert\Type(type: 'string', message: 'raison_echec_string')]
    private ?string $raison_echec = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_echec = null;

    #[ORM\OneToOne(mappedBy: 'tache', cascade: ['persist', 'remove'])]
    private ?Commentaire $commentaire = null;

    #[ORM\OneToOne(mappedBy: 'tache', cascade: ['persist', 'remove'])]
    private ?PieceJointe $pieceJointe = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'not_blank_budget_tache')]
    #[Assert\Positive(message: 'budget_tache_positive')]
    #[Assert\Type(type: 'float', message: 'budget_tache_float')]
    private ?float $budget = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateLimite(): ?\DateTimeInterface
    {
        return $this->date_limite;
    }

    public function setDateLimite(\DateTimeInterface $date_limite): static
    {
        $this->date_limite = $date_limite;

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

    public function getNomTache(): ?string
    {
        return $this->nom_tache;
    }

    public function setNomTache(string $nom_tache): static
    {
        $this->nom_tache = $nom_tache;

        return $this;
    }

    public function getValidateur(): ?User
    {
        return $this->validateur;
    }

    public function setValidateur(?User $validateur): static
    {
        $this->validateur = $validateur;

        return $this;
    }

    public function getDateValidation(): ?\DateTimeInterface
    {
        return $this->date_validation;
    }

    public function setDateValidation(?\DateTimeInterface $date_validation): static
    {
        $this->date_validation = $date_validation;

        return $this;
    }

    public function getRaisonEchec(): ?string
    {
        return $this->raison_echec;
    }

    public function setRaisonEchec(?string $raison_echec): static
    {
        $this->raison_echec = $raison_echec;

        return $this;
    }

    public function getDateEchec(): ?\DateTimeInterface
    {
        return $this->date_echec;
    }

    public function setDateEchec(?\DateTimeInterface $date_echec): static
    {
        $this->date_echec = $date_echec;

        return $this;
    }

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(Commentaire $commentaire): static
    {
        // set the owning side of the relation if necessary
        if ($commentaire->getTache() !== $this) {
            $commentaire->setTache($this);
        }

        $this->commentaire = $commentaire;

        return $this;
    }

    public function getPieceJointe(): ?PieceJointe
    {
        return $this->pieceJointe;
    }

    public function setPieceJointe(PieceJointe $pieceJointe): static
    {
        // set the owning side of the relation if necessary
        if ($pieceJointe->getTache() !== $this) {
            $pieceJointe->setTache($this);
        }

        $this->pieceJointe = $pieceJointe;

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
}
