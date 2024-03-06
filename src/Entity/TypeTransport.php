<?php

namespace App\Entity;

use App\Repository\TypeTransportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeTransportRepository::class)]
class TypeTransport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $LibelleTransport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleTransport(): ?string
    {
        return $this->LibelleTransport;
    }

    public function setLibelleTransport(string $LibelleTransport): static
    {
        $this->LibelleTransport = $LibelleTransport;

        return $this;
    }
}
