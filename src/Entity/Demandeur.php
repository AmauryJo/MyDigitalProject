<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use App\Repository\DemandeurRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

#[ORM\Entity(repositoryClass: DemandeurRepository::class)]
#[UniqueEntity(fields: ['mail'], message: 'There is already an account with this mail')]
class Demandeur implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\-\' ]+$/',
        message: 'Le nom doit contenir uniquement des lettres, des tirets, des apostrophes et des espaces.'
    )]
    private ?string $nom = null;

    #[ORM\Column(length: 50)]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\-\' ]+$/',
        message: 'Le prénom doit contenir uniquement des lettres, des tirets, des apostrophes et des espaces.'
    )]
    private ?string $prenom = null;

    #[ORM\Column(length: 50)]
    private ?string $mail = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
        message: 'Le mot de passe doit contenir au moins 8 caractères, inclure une majuscule, une minuscule, un chiffre et un caractère spécial.'
    )]
    private ?string $password = null;

    #[ORM\Column(length: 15)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Le numéro de téléphone doit contenir uniquement des chiffres.'
    )]
    private ?string $telephone = null;

    #[ORM\Column(length: 50)]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ\-\' ]+$/',
        message: 'La ville doit contenir uniquement des lettres, des tirets, des apostrophes et des espaces.'
    )]
    private ?string $ville = null;

    #[ORM\Column(length: 5)]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Le code postal doit contenir uniquement des chiffres.'
    )]
    private ?string $codePostal = null;

    #[ORM\Column]
    #[Assert\Regex(
        pattern: '/^\d+$/',
        message: 'Le numéro de rue doit contenir uniquement des chiffres.'
    )]
    private ?int $numeroRue = null;

    #[ORM\Column(length: 255)]
    #[Assert\Regex(
        pattern: '/^[a-zA-ZÀ-ÿ0-9\-\' ]+$/',
        message: 'Le nom de la rue doit contenir uniquement des lettres, des chiffres, des tirets, des apostrophes et des espaces.'
    )]
    private ?string $rue = null;

    #[ORM\Column(nullable: true)]
    private ?bool $newsletter = null;

    #[ORM\Column(nullable: true)]
    private ?bool $mailVerified = null;

    #[ORM\OneToOne(mappedBy: 'demandeur', cascade: ['persist', 'remove'])]
    private ?Cv $cv = null;

    #[ORM\OneToOne(mappedBy: 'demandeur', cascade: ['persist', 'remove'])]
    private ?Fichier $fichier = null;

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): static
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->codePostal;
    }

    public function setCodePostal(string $codePostal): static
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    public function getNumeroRue(): ?int
    {
        return $this->numeroRue;
    }

    public function setNumeroRue(int $numeroRue): static
    {
        $this->numeroRue = $numeroRue;

        return $this;
    }

    public function getRue(): ?string
    {
        return $this->rue;
    }

    public function setRue(string $rue): static
    {
        $this->rue = $rue;

        return $this;
    }

    public function isNewsletter(): ?bool
    {
        return $this->newsletter;
    }

    public function setNewsletter(bool $newsletter): static
    {
        $this->newsletter = $newsletter;

        return $this;
    }

    public function isMailVerified(): ?bool
    {
        return $this->mailVerified;
    }

    public function setMailVerified(bool $mailVerified): static
    {
        $this->mailVerified = $mailVerified;

        return $this;
    }

    public function getCv(): ?Cv
    {
        return $this->cv;
    }

    public function setCv(Cv $cv): static
    {
        // set the owning side of the relation if necessary
        if ($cv->getDemandeur() !== $this) {
            $cv->setDemandeur($this);
        }

        $this->cv = $cv;

        return $this;
    }

    public function getFichier(): ?Fichier
    {
        return $this->fichier;
    }

    public function setFichier(?Fichier $fichier): self
    {
        $this->fichier = $fichier;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return $this->mail; // Utilisez la colonne mail comme identifiant unique
    }

    public function getRoles(): array
    {
        // Retourner les rôles de l'utilisateur, par défaut ROLE_USER
        $roles = ['ROLE_USER'];
        return array_unique($roles);
    }

    public function getSalt()
    {
        // Vous pouvez laisser cette méthode vide si vous utilisez bcrypt ou sodium
    }

    public function eraseCredentials() : void
    {
        // Effacez les informations sensibles si nécessaire
    }
}
