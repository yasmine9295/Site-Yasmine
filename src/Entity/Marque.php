<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nomM = null;

    #[ORM\Column(length: 255)]
    private ?string $CreateurM = null;

    #[ORM\Column(length: 255)]
    private ?string $HistoireM = null;

    #[ORM\Column(length: 255)]
    private ?string $RepresentantM = null;

    #[ORM\Column(length: 255)]
    private ?string $Image = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomM(): ?string
    {
        return $this->nomM;
    }

    public function setNomM(string $nomM): static
    {
        $this->nomM = $nomM;

        return $this;
    }

    public function getCreateurM(): ?string
    {
        return $this->CreateurM;
    }

    public function setCreateurM(string $CreateurM): static
    {
        $this->CreateurM = $CreateurM;

        return $this;
    }

    public function getHistoireM(): ?string
    {
        return $this->HistoireM;
    }

    public function setHistoireM(string $HistoireM): static
    {
        $this->HistoireM = $HistoireM;

        return $this;
    }

    public function getRepresentantM(): ?string
    {
        return $this->RepresentantM;
    }

    public function setRepresentantM(string $RepresentantM): static
    {
        $this->RepresentantM = $RepresentantM;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->Image;
    }

    public function setImage(string $Image): static
    {
        $this->Image = $Image;

        return $this;
    }
}
