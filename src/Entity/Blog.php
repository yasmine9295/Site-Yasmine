<?php

namespace App\Entity;

use App\Repository\BlogRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BlogRepository::class)]
class Blog
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NomArticle = null;

    #[ORM\Column(length: 255)]
    private ?string $Contenu = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Date = null;

    #[ORM\ManyToOne(inversedBy: 'blogs')]
    #[ORM\JoinColumn(nullable: true)]
    private ?Defile $defile = null;

    #[ORM\OneToMany(mappedBy: 'blog', targetEntity: ImageBlog::class)]
    private Collection $imageBlogs;

    public function __construct()
    {
        $this->imageBlogs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomArticle(): ?string
    {
        return $this->NomArticle;
    }

    public function setNomArticle(string $NomArticle): static
    {
        $this->NomArticle = $NomArticle;

        return $this;
    }

    public function getContenu(): ?string
    {
        return $this->Contenu;
    }

    public function setContenu(string $Contenu): static
    {
        $this->Contenu = $Contenu;

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

    public function getDefile(): ?Defile
    {
        return $this->defile;
    }

    public function setDefile(?Defile $defile): static
    {
        $this->defile = $defile;

        return $this;
    }

    /**
     * @return Collection<int, ImageBlog>
     */
    public function getImageBlogs(): Collection
    {
        return $this->imageBlogs;
    }

    public function addImageBlog(ImageBlog $imageBlog): static
    {
        if (!$this->imageBlogs->contains($imageBlog)) {
            $this->imageBlogs->add($imageBlog);
            $imageBlog->setBlog($this);
        }

        return $this;
    }

    public function removeImageBlog(ImageBlog $imageBlog): static
    {
        if ($this->imageBlogs->removeElement($imageBlog)) {
            // set the owning side to null (unless already changed)
            if ($imageBlog->getBlog() === $this) {
                $imageBlog->setBlog(null);
            }
        }

        return $this;
    }
}
