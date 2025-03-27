<?php

namespace App\Entity;

use App\Repository\SpecialisationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpecialisationRepository::class)]
class Specialisation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'specialisation', targetEntity: Mannequins::class)]
    private Collection $mannequins;



    public function __construct()
    {
        $this->mannequins = new ArrayCollection();
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

    /**
     * @return Collection<int, Mannequins>
     */
    public function getMannequins(): Collection
    {
        return $this->mannequins;
    }

    public function addMannequin(Mannequins $mannequin): static
    {
        if (!$this->mannequins->contains($mannequin)) {
            $this->mannequins->add($mannequin);
            $mannequin->setSpecialisation($this);
        }

        return $this;
    }

    public function removeMannequin(Mannequins $mannequin): static
    {
        if ($this->mannequins->removeElement($mannequin)) {
            // set the owning side to null (unless already changed)
            if ($mannequin->getSpecialisation() === $this) {
                $mannequin->setSpecialisation(null);
            }
        }

        return $this;
    }


}
