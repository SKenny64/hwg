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
    private ?string $name_transport = null;

    #[ORM\OneToOne(mappedBy: 'type_transport', cascade: ['persist', 'remove'])]
    private ?Transport $transport = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameTransport(): ?string
    {
        return $this->name_transport;
    }

    public function setNameTransport(string $name_transport): static
    {
        $this->name_transport = $name_transport;

        return $this;
    }

    public function getTransport(): ?Transport
    {
        return $this->transport;
    }

    public function setTransport(?Transport $transport): static
    {
        // unset the owning side of the relation if necessary
        if ($transport === null && $this->transport !== null) {
            $this->transport->setTypeTransport(null);
        }

        // set the owning side of the relation if necessary
        if ($transport !== null && $transport->getTypeTransport() !== $this) {
            $transport->setTypeTransport($this);
        }

        $this->transport = $transport;

        return $this;
    }
}
