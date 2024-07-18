<?php

namespace App\Entity;

use App\Repository\PieceJointeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: PieceJointeRepository::class)]
class PieceJointe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'pieceJointe', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tache $tache = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $auteur = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_nom_fichier_piece_jointe')]
    #[Assert\Length(min: 10, minMessage: 'nom_fichier_piece_jointe_min_length', max: 255, maxMessage: 'nom_fichier_piece_jointe_max_length')]
    #[Assert\Type(type: 'string', message: 'nom_fichier_piece_jointe_string')]
    private ?string $nom_fichier = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_chemin_fichier_piece_jointe')]
    #[Assert\Length(min: 10, minMessage: 'chemin_fichier_piece_jointe_min_length', max: 255, maxMessage: 'chemin_fichier_piece_jointe_max_length')]
    #[Assert\Type(type: 'string', message: 'chemin_fichier_piece_jointe_string')]
    private ?string $chemin_fichier = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: 'not_blank_type_fichier_piece_jointe')]
    #[Assert\Length(min: 10, minMessage: 'type_fichier_piece_jointe_min_length', max: 255, maxMessage: 'type_fichier_piece_jointe_max_length')]
    #[Assert\Type(type: 'string', message: 'type_fichier_piece_jointe_string')]
    private ?string $type_fichier = null;

    #[ORM\Column]
    #[Assert\NotBlank(message: 'not_blank_taille_fichier_piece_jointe')]
    #[Assert\Positive(message: 'taille_fichier_piece_jointe_positive')]
    #[Assert\Type(type: 'float', message: 'taille_fichier_piece_jointe_float')]
    private ?float $taille_fichier = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, options: ['default' => 'CURRENT_TIMESTAMP'])]
    private ?\DateTimeInterface $date_creation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTache(): ?Tache
    {
        return $this->tache;
    }

    public function setTache(Tache $tache): static
    {
        $this->tache = $tache;

        return $this;
    }

    public function getAuteur(): ?User
    {
        return $this->auteur;
    }

    public function setAuteur(User $auteur): static
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getNomFichier(): ?string
    {
        return $this->nom_fichier;
    }

    public function setNomFichier(string $nom_fichier): static
    {
        $this->nom_fichier = $nom_fichier;

        return $this;
    }

    public function getCheminFichier(): ?string
    {
        return $this->chemin_fichier;
    }

    public function setCheminFichier(string $chemin_fichier): static
    {
        $this->chemin_fichier = $chemin_fichier;

        return $this;
    }

    public function getTypeFichier(): ?string
    {
        return $this->type_fichier;
    }

    public function setTypeFichier(string $type_fichier): static
    {
        $this->type_fichier = $type_fichier;

        return $this;
    }

    public function getTailleFichier(): ?float
    {
        return $this->taille_fichier;
    }

    public function setTailleFichier(float $taille_fichier): static
    {
        $this->taille_fichier = $taille_fichier;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): static
    {
        $this->date_creation = $date_creation;

        return $this;
    }
}
