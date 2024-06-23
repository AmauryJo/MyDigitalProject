<?php

namespace App\Entity;

use App\Repository\OffreEmploiRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: OffreEmploiRepository::class)]
class OffreEmploi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Assert\NotBlank]
    private ?string $offre_intitule = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $offre_description = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $presentation_entreprise = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\NotBlank]
    private ?string $mission_offre = null;

    #[ORM\Column(type: 'integer', length: 10)]
    #[Assert\NotBlank]
    #[Assert\Range(min: 0, max: 100000)]
    private ?int $offre_remuneration = null;

    #[ORM\ManyToOne(inversedBy: 'entreprise', cascade: ['persist', 'remove'])]
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

    public function getPresentationEntreprise(): ?string
    {
        return $this->presentation_entreprise;
    }

    public function setPresentationEntreprise(string $presentation_entreprise): static
    {
        $this->presentation_entreprise = $presentation_entreprise;

        return $this;
    }

    public function getMissionOffre(): ?string
    {
        return $this->mission_offre;
    }

    public function setMissionOffre(string $mission_offre): static
    {
        $this->mission_offre = $mission_offre;

        return $this;
    }

    public function getOffreRemuneration(): ?int
    {
        return $this->offre_remuneration;
    }

    public function setOffreRemuneration(int $offre_remuneration): static
    {
        $this->offre_remuneration = $offre_remuneration;

        return $this;
    }

    public function getEntreprise(): ?Entreprises
    {
        return $this->entreprise;
    }

    public function setEntreprise(Entreprises $entreprise): static
    {
        $this->entreprise = $entreprise;

        return $this;
    }
}
