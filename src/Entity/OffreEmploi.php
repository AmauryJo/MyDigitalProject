<?php

namespace App\Entity;

use App\Repository\OffreEmploiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OffreEmploiRepository::class)]
class OffreEmploi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $offre_intitule = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $offre_description = null;

    #[ORM\Column(length: 20)]
    private ?string $offre_remuneration = null;

    #[ORM\OneToOne(inversedBy: 'entreprise', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Entreprises $entreprise = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOffreIntitule(): ?string
    {
        return $this->offre_intitule;
    }

    public function setOffreIntitule(string $offre_intitule): static
    {
        $this->offre_intitule = $offre_intitule;

        return $this;
    }

    public function getOffreDescription(): ?string
    {
        return $this->offre_description;
    }

    public function setOffreDescription(string $offre_description): static
    {
        $this->offre_description = $offre_description;

        return $this;
    }

    public function getOffreRemuneration(): ?string
    {
        return $this->offre_remuneration;
    }

    public function setOffreRemuneration(string $offre_remuneration): static
    {
        $this->offre_remuneration = $offre_remuneration;

        return $this;
    }

    public function getEntreprise(): ?entreprises
    {
        return $this->entreprise;
    }

    public function setEntreprise(entreprises $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
