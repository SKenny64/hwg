<?php

namespace App\Entity;

use App\Repository\EvenementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EvenementRepository::class)]
class Evenement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    private ?string $nomEvenement = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateEvenement = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    private ?\DateTimeInterface $heureEvenement = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $descriptif = null;

    #[ORM\Column(length: 100)]
    private ?string $villeEvenement = null;

    #[ORM\Column(length: 50)]
    private ?string $codePostalEvenement = null;

    #[ORM\Column(length: 150)]
    private ?string $nomLieu = null;

    #[ORM\Column(nullable: true)]
    private ?int $capaciteTotal = null;

    #[ORM\Column(length: 10, nullable: true)]
    private ?string $duree = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 6, scale: 2, nullable: true)]
    private ?string $tarifEvenement = null;

    #[ORM\Column(length: 50)]
    private ?string $statusEvenement = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $dateCreation = null;

    #[ORM\ManyToOne(inversedBy: 'evenements')]
    private ?Categorie $categorie = null;

    #[ORM\OneToMany(targetEntity: ImageEvenement::class, mappedBy: 'evenement')]
    private Collection $ImageEvenement;

    public function __construct()
    {
        $this->ImageEvenement = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEvenement(): ?string
    {
        return $this->nomEvenement;
    }

    public function setNomEvenement(string $nomEvenement): static
    {
        $this->nomEvenement = $nomEvenement;

        return $this;
    }

    public function getDateEvenement(): ?\DateTimeInterface
    {
        return $this->dateEvenement;
    }

    public function setDateEvenement(\DateTimeInterface $dateEvenement): static
    {
        $this->dateEvenement = $dateEvenement;

        return $this;
    }

    public function getHeureEvenement(): ?\DateTimeInterface
    {
        return $this->heureEvenement;
    }

    public function setHeureEvenement(\DateTimeInterface $heureEvenement): static
    {
        $this->heureEvenement = $heureEvenement;

        return $this;
    }

    public function getDescriptif(): ?string
    {
        return $this->descriptif;
    }

    public function setDescriptif(string $descriptif): static
    {
        $this->descriptif = $descriptif;

        return $this;
    }

    public function getVilleEvenement(): ?string
    {
        return $this->villeEvenement;
    }

    public function setVilleEvenement(string $villeEvenement): static
    {
        $this->villeEvenement = $villeEvenement;

        return $this;
    }

    public function getCodePostalEvenement(): ?string
    {
        return $this->codePostalEvenement;
    }

    public function setCodePostalEvenement(string $codePostalEvenement): static
    {
        $this->codePostalEvenement = $codePostalEvenement;

        return $this;
    }

    public function getNomLieu(): ?string
    {
        return $this->nomLieu;
    }

    public function setNomLieu(string $nomLieu): static
    {
        $this->nomLieu = $nomLieu;

        return $this;
    }

    public function getCapaciteTotal(): ?int
    {
        return $this->capaciteTotal;
    }

    public function setCapaciteTotal(?int $capaciteTotal): static
    {
        $this->capaciteTotal = $capaciteTotal;

        return $this;
    }

    public function getDuree(): ?string
    {
        return $this->duree;
    }

    public function setDuree(?string $duree): static
    {
        $this->duree = $duree;

        return $this;
    }

    public function getTarifEvenement(): ?string
    {
        return $this->tarifEvenement;
    }

    public function setTarifEvenement(?string $tarifEvenement): static
    {
        $this->tarifEvenement = $tarifEvenement;

        return $this;
    }

    public function getStatusEvenement(): ?string
    {
        return $this->statusEvenement;
    }

    public function setStatusEvenement(string $statusEvenement): static
    {
        $this->statusEvenement = $statusEvenement;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeImmutable
    {
        return $this->dateCreation;
    }

    public function setDateCreation(?\DateTimeImmutable $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * @return Collection<int, ImageEvenement>
     */
    public function getImageEvenement(): Collection
    {
        return $this->ImageEvenement;
    }

    public function addImageEvenement(ImageEvenement $imageEvenement): static
    {
        if (!$this->ImageEvenement->contains($imageEvenement)) {
            $this->ImageEvenement->add($imageEvenement);
            $imageEvenement->setEvenement($this);
        }

        return $this;
    }

    public function removeImageEvenement(ImageEvenement $imageEvenement): static
    {
        if ($this->ImageEvenement->removeElement($imageEvenement)) {
            // set the owning side to null (unless already changed)
            if ($imageEvenement->getEvenement() === $this) {
                $imageEvenement->setEvenement(null);
            }
        }

        return $this;
    }
}
