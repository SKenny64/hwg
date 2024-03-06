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
    private ?string $LibelleTransport = null;

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

    public function getLibelleTransport(): ?string
    {
        return $this->LibelleTransport;
    }

    public function setLibelleTransport(string $LibelleTransport): static
    {
        $this->LibelleTransport = $LibelleTransport;

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
