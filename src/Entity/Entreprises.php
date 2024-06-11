<?php

namespace App\Entity;

use App\Repository\EntreprisesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntreprisesRepository::class)]
class Entreprises
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $entr_password = null;

    #[ORM\Column]
    private ?int $entr_tel = null;

    #[ORM\Column(length: 100)]
    private ?string $entr_mail = null;

    #[ORM\Column(length: 50)]
    private ?string $entr_nom = null;

    #[ORM\Column(length: 50)]
    private ?string $entr_secteurActivite = null;

    #[ORM\Column(length: 20)]
    private ?string $entr_nombreEmploye = null;

    #[ORM\OneToOne(mappedBy: 'entreprise', cascade: ['persist', 'remove'])]
    private ?OffreEmploi $entreprise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEntrPassword(): ?string
    {
        return $this->entr_password;
    }

    public function setEntrPassword(string $entr_password): static
    {
        $this->entr_password = $entr_password;

        return $this;
    }

    public function getEntrTel(): ?int
    {
        return $this->entr_tel;
    }

    public function setEntrTel(int $entr_tel): static
    {
        $this->entr_tel = $entr_tel;

        return $this;
    }

    public function getEntrMail(): ?string
    {
        return $this->entr_mail;
    }

    public function setEntrMail(string $entr_mail): static
    {
        $this->entr_mail = $entr_mail;

        return $this;
    }

    public function getEntrNom(): ?string
    {
        return $this->entr_nom;
    }

    public function setEntrNom(string $entr_nom): static
    {
        $this->entr_nom = $entr_nom;

        return $this;
    }

    public function getEntrSecteurActivite(): ?string
    {
        return $this->entr_secteurActivite;
    }

    public function setEntrSecteurActivite(string $entr_secteurActivite): static
    {
        $this->entr_secteurActivite = $entr_secteurActivite;

        return $this;
    }

    public function getEntrNombreEmploye(): ?string
    {
        return $this->entr_nombreEmploye;
    }

    public function setEntrNombreEmploye(string $entr_nombreEmploye): static
    {
        $this->entr_nombreEmploye = $entr_nombreEmploye;

        return $this;
    }

    public function getEntreprise(): ?OffreEmploi
    {
        return $this->entreprise;
    }

    public function setEntreprise(OffreEmploi $entreprise): static
    {
        // set the owning side of the relation if necessary
        if ($entreprise->getEntreprise() !== $this) {
            $entreprise->setEntreprise($this);
        }

        $this->entreprise = $entreprise;

        return $this;
    }
}
