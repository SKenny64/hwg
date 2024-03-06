<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 120)]
    private ?string $name_event = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_event = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $hour_event = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date_event_creation = null;

    #[ORM\Column(length: 150)]
    private ?string $city_event = null;

    #[ORM\Column(length: 255)]
    private ?string $adress_event = null;

    #[ORM\Column(length: 50)]
    private ?string $zip_event = null;

    #[ORM\Column(length: 180)]
    private ?string $name_place = null;

    #[ORM\Column]
    private ?int $total_capacity = null;

    #[ORM\Column(length: 10)]
    private ?string $duration = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2)]
    private ?string $price_event = null;

    #[ORM\Column(length: 50)]
    private ?string $event_status = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    private ?Category $category = null;

    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'event')]
    private Collection $transport;

    #[ORM\OneToMany(targetEntity: ImageEvent::class, mappedBy: 'event')]
    private Collection $ImageEvent;

    public function __construct()
    {
        $this->transport = new ArrayCollection();
        $this->ImageEvent = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEvent(): ?string
    {
        return $this->name_event;
    }

    public function setNameEvent(string $name_event): static
    {
        $this->name_event = $name_event;

        return $this;
    }

    public function getDateEvent(): ?\DateTimeInterface
    {
        return $this->date_event;
    }

    public function setDateEvent(\DateTimeInterface $date_event): static
    {
        $this->date_event = $date_event;

        return $this;
    }

    public function getHourEvent(): ?\DateTimeInterface
    {
        return $this->hour_event;
    }

    public function setHourEvent(\DateTimeInterface $hour_event): static
    {
        $this->hour_event = $hour_event;

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

    public function getDateEventCreation(): ?\DateTimeImmutable
    {
        return $this->date_event_creation;
    }

    public function setDateEventCreation(\DateTimeImmutable $date_event_creation): static
    {
        $this->date_event_creation = $date_event_creation;

        return $this;
    }

    public function getCityEvent(): ?string
    {
        return $this->city_event;
    }

    public function setCityEvent(string $city_event): static
    {
        $this->city_event = $city_event;

        return $this;
    }

    public function getAdressEvent(): ?string
    {
        return $this->adress_event;
    }

    public function setAdressEvent(string $adress_event): static
    {
        $this->adress_event = $adress_event;

        return $this;
    }

    public function getZipEvent(): ?string
    {
        return $this->zip_event;
    }

    public function setZipEvent(string $zip_event): static
    {
        $this->zip_event = $zip_event;

        return $this;
    }

    public function getNamePlace(): ?string
    {
        return $this->name_place;
    }

    public function setNamePlace(string $name_place): static
    {
        $this->name_place = $name_place;

        return $this;
    }

    public function getTotalCapacity(): ?int
    {
        return $this->total_capacity;
    }

    public function setTotalCapacity(int $total_capacity): static
    {
        $this->total_capacity = $total_capacity;

        return $this;
    }

    public function getDuration(): ?string
    {
        return $this->duration;
    }

    public function setDuration(string $duration): static
    {
        $this->duration = $duration;

        return $this;
    }

    public function getPriceEvent(): ?string
    {
        return $this->price_event;
    }

    public function setPriceEvent(string $price_event): static
    {
        $this->price_event = $price_event;

        return $this;
    }

    public function getEventStatus(): ?string
    {
        return $this->event_status;
    }

    public function setEventStatus(string $event_status): static
    {
        $this->event_status = $event_status;

        return $this;
    }

    /**
     * @return Collection<int, transport>
    */
    public function getTransport(): Collection
    {
        return $this->transport;
    }

    public function setTransport(?Transport $transport): static
    {
        // unset the owning side of the relation if necessary
        if ($transport === null && $this->transport !== null) {
            $this->transport->setEvent(null);
        }

        // set the owning side of the relation if necessary
        if ($transport !== null && $transport->getEvent() !== $this) {
            $transport->setEvent($this);
        }

        $this->transport = $transport;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getImageEvent(): ?ImageEvent
    {
        return $this->imageEvent;
    }

    public function setImageEvent(?ImageEvent $imageEvent): static
    {
        // unset the owning side of the relation if necessary
        if ($imageEvent === null && $this->imageEvent !== null) {
            $this->imageEvent->setEvent(null);
        }

        // set the owning side of the relation if necessary
        if ($imageEvent !== null && $imageEvent->getEvent() !== $this) {
            $imageEvent->setEvent($this);
        }

        $this->imageEvent = $imageEvent;

        return $this;
    }

    public function addTransport(Transport $transport): static
    {
        if (!$this->transport->contains($transport)) {
            $this->transport->add($transport);
            $transport->setEvent($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): static
    {
        if ($this->transport->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getEvent() === $this) {
                $transport->setEvent(null);
            }
        }

        return $this;
    }

    public function addImageEvent(ImageEvent $imageEvent): static
    {
        if (!$this->ImageEvent->contains($imageEvent)) {
            $this->ImageEvent->add($imageEvent);
            $imageEvent->setEvent($this);
        }

        return $this;
    }

    public function removeImageEvent(ImageEvent $imageEvent): static
    {
        if ($this->ImageEvent->removeElement($imageEvent)) {
            // set the owning side to null (unless already changed)
            if ($imageEvent->getEvent() === $this) {
                $imageEvent->setEvent(null);
            }
        }

        return $this;
    }
}
