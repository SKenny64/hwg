<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180)]
    private ?string $email = null;

    /**
     * @var list<string> The user roles
     */
    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $avatar = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $DateCreationUser = null;

    #[ORM\OneToMany(targetEntity: Evenement::class, mappedBy: 'User')]
    private Collection $evenements;

    #[ORM\OneToMany(targetEntity: Participation::class, mappedBy: 'user')]
    private Collection $participation;

    #[ORM\OneToMany(targetEntity: Transport::class, mappedBy: 'user')]
    private Collection $transport;

    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'user')]
    private Collection $reservation;

    #[ORM\OneToMany(targetEntity: Adresse::class, mappedBy: 'user')]
    private Collection $adresse;

    #[ORM\OneToMany(targetEntity: CoordonneesOrganisateur::class, mappedBy: 'user')]
    private Collection $CoordonneesOrganisateur;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->participation = new ArrayCollection();
        $this->transport = new ArrayCollection();
        $this->reservation = new ArrayCollection();
        $this->adresse = new ArrayCollection();
        $this->CoordonneesOrganisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getAvatar(): ?string
    {
        return $this->avatar;
    }

    public function setAvatar(?string $avatar): static
    {
        $this->avatar = $avatar;

        return $this;
    }

    public function getDateCreationUser(): ?\DateTimeImmutable
    {
        return $this->DateCreationUser;
    }

    public function setDateCreationUser(?\DateTimeImmutable $DateCreationUser): static
    {
        $this->DateCreationUser = $DateCreationUser;

        return $this;
    }

    /**
     * @return Collection<int, Evenement>
     */
    public function getEvenements(): Collection
    {
        return $this->evenements;
    }

    public function addEvenement(Evenement $evenement): static
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements->add($evenement);
            $evenement->setUser($this);
        }

        return $this;
    }

    public function removeEvenement(Evenement $evenement): static
    {
        if ($this->evenements->removeElement($evenement)) {
            // set the owning side to null (unless already changed)
            if ($evenement->getUser() === $this) {
                $evenement->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Participation>
     */
    public function getParticipation(): Collection
    {
        return $this->participation;
    }

    public function addParticipation(Participation $participation): static
    {
        if (!$this->participation->contains($participation)) {
            $this->participation->add($participation);
            $participation->setUser($this);
        }

        return $this;
    }

    public function removeParticipation(Participation $participation): static
    {
        if ($this->participation->removeElement($participation)) {
            // set the owning side to null (unless already changed)
            if ($participation->getUser() === $this) {
                $participation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Transport>
     */
    public function getTransport(): Collection
    {
        return $this->transport;
    }

    public function addTransport(Transport $transport): static
    {
        if (!$this->transport->contains($transport)) {
            $this->transport->add($transport);
            $transport->setUser($this);
        }

        return $this;
    }

    public function removeTransport(Transport $transport): static
    {
        if ($this->transport->removeElement($transport)) {
            // set the owning side to null (unless already changed)
            if ($transport->getUser() === $this) {
                $transport->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Reservation>
     */
    public function getReservation(): Collection
    {
        return $this->reservation;
    }

    public function addReservation(Reservation $reservation): static
    {
        if (!$this->reservation->contains($reservation)) {
            $this->reservation->add($reservation);
            $reservation->setUser($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getUser() === $this) {
                $reservation->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Adresse>
     */
    public function getAdresse(): Collection
    {
        return $this->adresse;
    }

    public function addAdresse(Adresse $adresse): static
    {
        if (!$this->adresse->contains($adresse)) {
            $this->adresse->add($adresse);
            $adresse->setUser($this);
        }

        return $this;
    }

    public function removeAdresse(Adresse $adresse): static
    {
        if ($this->adresse->removeElement($adresse)) {
            // set the owning side to null (unless already changed)
            if ($adresse->getUser() === $this) {
                $adresse->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CoordonneesOrganisateur>
     */
    public function getCoordonneesOrganisateur(): Collection
    {
        return $this->CoordonneesOrganisateur;
    }

    public function addCoordonneesOrganisateur(CoordonneesOrganisateur $coordonneesOrganisateur): static
    {
        if (!$this->CoordonneesOrganisateur->contains($coordonneesOrganisateur)) {
            $this->CoordonneesOrganisateur->add($coordonneesOrganisateur);
            $coordonneesOrganisateur->setUser($this);
        }

        return $this;
    }

    public function removeCoordonneesOrganisateur(CoordonneesOrganisateur $coordonneesOrganisateur): static
    {
        if ($this->CoordonneesOrganisateur->removeElement($coordonneesOrganisateur)) {
            // set the owning side to null (unless already changed)
            if ($coordonneesOrganisateur->getUser() === $this) {
                $coordonneesOrganisateur->setUser(null);
            }
        }

        return $this;
    }
}
