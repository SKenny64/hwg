<?php

namespace App\Entity;

use App\Repository\TransportRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TransportRepository::class)]
class Transport
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2, nullable: true)]
    private ?string $TarifPersonne = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $descriptif = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $InfoContact = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $DateDepart = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $DateCreation = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $LieuDepart = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    private ?int $NbPlace = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $InfoPaiement = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $StatutTransport = null;

    #[ORM\ManyToOne(inversedBy: 'transports')]
    private ?TypeTransport $TypeTransport = null;

    #[ORM\ManyToOne(inversedBy: 'transport')]
    private ?Evenement $evenement = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTarifPersonne(): ?string
    {
        return $this->TarifPersonne;
    }

    public function setTarifPersonne(?string $TarifPersonne): static
    {
        $this->TarifPersonne = $TarifPersonne;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(?string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getInfoContact(): ?string
    {
        return $this->InfoContact;
    }

    public function setInfoContact(?string $InfoContact): static
    {
        $this->InfoContact = $InfoContact;

        return $this;
    }

    public function getDateDepart(): ?\DateTimeImmutable
    {
        return $this->DateDepart;
    }

    public function setDateDepart(?\DateTimeImmutable $DateDepart): static
    {
        $this->DateDepart = $DateDepart;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->DateCreation;
    }

    public function setDateCreation(?\DateTimeImmutable $DateCreation): static
    {
        $this->DateCreation = $DateCreation;

        return $this;
    }

    public function getLieuDepart(): ?string
    {
        return $this->LieuDepart;
    }

    public function setLieuDepart(?string $LieuDepart): static
    {
        $this->LieuDepart = $LieuDepart;

        return $this;
    }

    public function getNbPlace(): ?int
    {
        return $this->NbPlace;
    }

    public function setNbPlace(?int $NbPlace): static
    {
        $this->NbPlace = $NbPlace;

        return $this;
    }

    public function getInfoPaiement(): ?string
    {
        return $this->InfoPaiement;
    }

    public function setInfoPaiement(?string $InfoPaiement): static
    {
        $this->InfoPaiement = $InfoPaiement;

        return $this;
    }

    public function getStatutTransport(): ?string
    {
        return $this->StatutTransport;
    }

    public function setStatutTransport(?string $StatutTransport): static
    {
        $this->StatutTransport = $StatutTransport;

        return $this;
    }

    public function getTypeTransport(): ?TypeTransport
    {
        return $this->TypeTransport;
    }

    public function setTypeTransport(?TypeTransport $TypeTransport): static
    {
        $this->TypeTransport = $TypeTransport;

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): static
    {
        $this->evenement = $evenement;

        return $this;
    }
}
