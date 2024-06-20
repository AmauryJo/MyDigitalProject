<?php

namespace App\Entity;

use App\Repository\EntreprisesRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: EntreprisesRepository::class)]
class Entreprises implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $entr_mail = null;

    #[ORM\Column(type: 'json')]
    private array $roles = ['ROLE_ENTREPRISES'];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    private ?string $secteur_activite = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre_employe = null;

    #[ORM\Column(type: 'integer', length: 10)]
    private ?int $telephone = null;

    public function __construct()
    {
        // Cette initialisation est redondante car elle est déjà faite lors de la déclaration de la propriété.
        $this->roles = ['ROLE_ENTREPRISES'];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrMail(): ?string
    {
        return $this->entr_mail;
    }

    public function setEntrMail(string $entr_mail): self
    {
        $this->entr_mail = $entr_mail;
        return $this;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;
        return $this;
    }

    public function getSecteurActivite(): ?string
    {
        return $this->secteur_activite;
    }

    public function setSecteurActivite(string $secteur_activite): self
    {
        $this->secteur_activite = $secteur_activite;
        return $this;
    }

    public function getNombreEmploye(): ?string
    {
        return $this->nombre_employe;
    }

    public function setNombreEmploye(string $nombre_employe): self
    {
        $this->nombre_employe = $nombre_employe;
        return $this;
    }

    public function getTelephone(): ?int
    {
        return $this->telephone;
    }

    public function setTelephone(int $telephone): self
    {
        $this->telephone = $telephone;
        return $this;
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->entr_mail;
    }

    public function eraseCredentials(): void
    {
        // Effacer les données temporaires sensibles
    }
}
