<?php

namespace App\Entity;

use App\Repository\ModePaiementTransportRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModePaiementTransportRepository::class)]
class ModePaiementTransport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $LibellePaiement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibellePaiement(): ?string
    {
        return $this->LibellePaiement;
    }

    public function setLibellePaiement(string $LibellePaiement): static
    {
        $this->LibellePaiement = $LibellePaiement;

        return $this;
    }
}
