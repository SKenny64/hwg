<?php

namespace App\Entity;

use App\Repository\ImageEvenementRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageEvenementRepository::class)]
class ImageEvenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $lienPhoto = null;

    #[ORM\Column(nullable: true)]
    private ?bool $couverture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLienPhoto(): ?string
    {
        return $this->lienPhoto;
    }

    public function setLienPhoto(?string $lienPhoto): static
    {
        $this->lienPhoto = $lienPhoto;

        return $this;
    }

    public function isCouverture(): ?bool
    {
        return $this->couverture;
    }

    public function setCouverture(?bool $couverture): static
    {
        $this->couverture = $couverture;

        return $this;
    }
}
