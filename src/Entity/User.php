<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Assert\NotBlank(message: 'not_blank_email')]
    #[Assert\Email(message: 'email_invalid')]
    #[Assert\Length(min: 6, max: 180, minMessage: 'email_min_length', maxMessage: 'email_max_length')]
    #[Assert\Type(type: 'string', message: 'email_unique')]
    #[Assert\Unique(message: 'email_unique')]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Assert\NotBlank]
    #[Assert\Length(min: 6, max: 255, minMessage: 'password_min_length', maxMessage: 'password_max_length')]
    #[Assert\Type(type: 'string', message: 'password_unique')]
    #[Assert\Unique(message: 'password_unique')]
    private ?string $password = null;

    #[ORM\OneToOne(mappedBy: 'validateur', cascade: ['persist', 'remove'])]
    private ?Tache $tachesValidees = null;

    #[ORM\OneToOne(mappedBy: 'auteur', cascade: ['persist', 'remove'])]
    private ?Commentaire $commentaire = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getTachesValidees(): ?Tache
    {
        return $this->tachesValidees;
    }

    public function setTachesValidees(?Tache $tachesValidees): static
    {
        // unset the owning side of the relation if necessary
        if ($tachesValidees === null && $this->tachesValidees !== null) {
            $this->tachesValidees->setValidateur(null);
        }

        // set the owning side of the relation if necessary
        if ($tachesValidees !== null && $tachesValidees->getValidateur() !== $this) {
            $tachesValidees->setValidateur($this);
        }

        $this->tachesValidees = $tachesValidees;

        return $this;
    }

    public function getCommentaire(): ?Commentaire
    {
        return $this->commentaire;
    }

    public function setCommentaire(Commentaire $commentaire): static
    {
        // set the owning side of the relation if necessary
        if ($commentaire->getAuteur() !== $this) {
            $commentaire->setAuteur($this);
        }

        $this->commentaire = $commentaire;

        return $this;
    }
}
