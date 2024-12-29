<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ThemeRepository::class)]
class Theme
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomT = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomT(): ?string
    {
        return $this->nomT;
    }

    public function setNomT(string $nomT): static
    {
        $this->nomT = $nomT;

        return $this;
    }
}
