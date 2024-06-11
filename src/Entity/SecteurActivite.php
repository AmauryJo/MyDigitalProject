<?php

namespace App\Entity;

use App\Repository\SecteurActiviteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SecteurActiviteRepository::class)]
class SecteurActivite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $secteur_nom = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSecteurNom(): ?string
    {
        return $this->secteur_nom;
    }

    public function setSecteurNom(string $secteur_nom): static
    {
        $this->secteur_nom = $secteur_nom;

        return $this;
    }
}
