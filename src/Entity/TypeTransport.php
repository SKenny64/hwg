<?php

namespace App\Entity;

use App\Repository\TypeTransportRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'TypeTransport')]
    private Collection $transports;

    public function __construct()
    {
        $this->transports = new ArrayCollection();
    }


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

    /**
     * @return Collection<int, Transport>
     */
    public function getTransports(): Collection
    {
        return $this->transports;
    }

    public function addTransport(Transport $transport): static
    {
        if (!$this->transports->contains($transport)) {
            $this->transports->add($transport);
            $transport->setTypeTransport($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): static
    {
        if ($this->transports->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getTypeTransport() === $this) {
                $transport->setTypeTransport(null);
            }
        }

        return $this;
    }
}
