<?php

namespace App\Entity;

use App\Repository\ImageEventRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ImageEventRepository::class)]
class ImageEvent
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture_link = null;

    #[ORM\Column]
    private ?bool $cover = null;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPictureLink(): ?string
    {
        return $this->picture_link;
    }

    public function setPictureLink(?string $picture_link): static
    {
        $this->picture_link = $picture_link;

        return $this;
    }

    public function isCover(): ?bool
    {
        return $this->cover;
    }

    public function setCover(bool $cover): static
    {
        $this->cover = $cover;

        return $this;
    }

    public function getEvent(): ?Event
    {
        return $this->event;
    }

    public function setEvent(?Event $event): static
    {
        $this->event = $event;

        return $this;
    }
}
