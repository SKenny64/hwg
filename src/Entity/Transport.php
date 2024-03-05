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

    #[ORM\Column(type: Types::DECIMAL, precision: 5, scale: 2)]
    private ?string $price_per_person = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $info_contact = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $date_creation_transport = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $place_departure = null;

    #[ORM\Column]
    private ?int $number_of_place = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $payment_info = null;

    #[ORM\Column(length: 50)]
    private ?string $transport_status = null;

    #[ORM\OneToOne(inversedBy: 'transport', cascade: ['persist', 'remove'])]
    private ?TypeTransport $type_transport = null;

    #[ORM\OneToOne(inversedBy: 'transport', cascade: ['persist', 'remove'])]
    private ?Event $event = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPricePerPerson(): ?string
    {
        return $this->price_per_person;
    }

    public function setPricePerPerson(string $price_per_person): static
    {
        $this->price_per_person = $price_per_person;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getInfoContact(): ?string
    {
        return $this->info_contact;
    }

    public function setInfoContact(string $info_contact): static
    {
        $this->info_contact = $info_contact;

        return $this;
    }

    public function getDateCreationTransport(): ?\DateTimeImmutable
    {
        return $this->date_creation_transport;
    }

    public function setDateCreationTransport(\DateTimeImmutable $date_creation_transport): static
    {
        $this->date_creation_transport = $date_creation_transport;

        return $this;
    }

    public function getPlaceDeparture(): ?string
    {
        return $this->place_departure;
    }

    public function setPlaceDeparture(string $place_departure): static
    {
        $this->place_departure = $place_departure;

        return $this;
    }

    public function getNumberOfPlace(): ?int
    {
        return $this->number_of_place;
    }

    public function setNumberOfPlace(int $number_of_place): static
    {
        $this->number_of_place = $number_of_place;

        return $this;
    }

    public function getPaymentInfo(): ?string
    {
        return $this->payment_info;
    }

    public function setPaymentInfo(string $payment_info): static
    {
        $this->payment_info = $payment_info;

        return $this;
    }

    public function getTransportStatus(): ?string
    {
        return $this->transport_status;
    }

    public function setTransportStatus(string $transport_status): static
    {
        $this->transport_status = $transport_status;

        return $this;
    }

    public function getTypeTransport(): ?TypeTransport
    {
        return $this->type_transport;
    }

    public function setTypeTransport(?TypeTransport $type_transport): static
    {
        $this->type_transport = $type_transport;

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
