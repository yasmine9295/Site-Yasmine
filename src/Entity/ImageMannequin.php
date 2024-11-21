<?php

namespace App\Entity;

use App\Repository\ImageMannequinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageMannequinRepository::class)]
class ImageMannequin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $image = null;

    #[ORM\ManyToOne(inversedBy: 'imageMannequins')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Mannequins $mannequinId = null;

    public function __construct()
    {
        $this->Mannequins = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): static
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getMannequins(): Collection
    {
        return $this->Mannequins;
    }

    public function addMannequin(self $mannequin): static
    {
        if (!$this->Mannequins->contains($mannequin)) {
            $this->Mannequins->add($mannequin);
            $mannequin->setImageMannequin($this);
        }

        return $this;
    }

    public function removeMannequin(self $mannequin): static
    {
        if ($this->Mannequins->removeElement($mannequin)) {
            // set the owning side to null (unless already changed)
            if ($mannequin->getImageMannequin() === $this) {
                $mannequin->setImageMannequin(null);
            }
        }

        return $this;
    }

    public function getMannequinId(): ?Mannequins
    {
        return $this->mannequinId;
    }

    public function setMannequinId(?Mannequins $mannequinId): static
    {
        $this->mannequinId = $mannequinId;

        return $this;
    }
}
