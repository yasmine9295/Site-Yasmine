<?php

namespace App\Entity;

use App\Repository\DefileRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DefileRepository::class)]
class Defile
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomD = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomD(): ?string
    {
        return $this->NomD;
    }

    public function setNomD(string $NomD): static
    {
        $this->NomD = $NomD;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): static
    {
        $this->Date = $Date;

        return $this;
    }
}
