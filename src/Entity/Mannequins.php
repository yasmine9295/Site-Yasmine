<?php

namespace App\Entity;

use App\Entity\Defile;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MannequinsRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: MannequinsRepository::class)]
class Mannequins
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le nom est obligatoire.")]
    #[Assert\Length(min: 2, minMessage: "Le nom doit comporter au moins {{ limit }} caractères.")]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "Le prénom est obligatoire.")]
    #[Assert\Length(min: 2, minMessage: "Le prénom doit comporter au moins {{ limit }} caractères.")]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank(message: "La nationalité est obligatoire.")]
    private ?string $nationalite = null;

    #[ORM\ManyToMany(targetEntity: Defile::class, mappedBy: 'mannequin')]
    private Collection $defiles;

    #[ORM\Column(length: 1000)]
    #[Assert\NotBlank(message: "La biographie est obligatoire.")]
    #[Assert\Length(min: 20, minMessage: "La biographie doit comporter au moins {{ limit }} caractères.")]
    private ?string $biographie = null;

    #[ORM\Column(length: 1000)]
    #[Assert\Url(message: "Veuillez entrer une URL valide.")]
    private ?string $imageMannequin = null;

    public function __construct()
    {
        $this->defiles = new ArrayCollection();
    }

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

    public function getNationalite(): ?string
    {
        return $this->nationalite;
    }

    public function setNationalite(string $nationalite): static
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * @return Collection<int, Defile>
     */
    public function getDefiles(): Collection
    {
        return $this->defiles;
    }

    public function addDefile(Defile $defile): static
    {
        if (!$this->defiles->contains($defile)) {
            $this->defiles->add($defile);
            $defile->addMannequin($this);
        }

        return $this;
    }

    public function removeDefile(Defile $defile): static
    {
        if ($this->defiles->removeElement($defile)) {
            $defile->removeMannequin($this);
        }

        return $this;
    }

    public function getBiographie(): ?string
    {
        return $this->biographie;
    }

    public function setBiographie(string $biographie): static
    {
        $this->biographie = $biographie;

        return $this;
    }

    public function getImageMannequin(): ?string
    {
        return $this->imageMannequin;
    }

    public function setImageMannequin(string $imageMannequin): static
    {
        $this->imageMannequin = $imageMannequin;

        return $this;
    }
}
