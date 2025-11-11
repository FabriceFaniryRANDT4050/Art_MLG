<?php

namespace App\Entity;

use App\Repository\PaiementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaiementRepository::class)]
class Paiement
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(length: 100)]
    private ?string $status = null;

    /**
     * @var Collection<int, Reservation>
     */
    #[ORM\OneToMany(targetEntity: Reservation::class, mappedBy: 'paiement')]
    private Collection $reservation;

    /**
     * @var Collection<int, ModePaiement>
     */
    #[ORM\ManyToMany(targetEntity: ModePaiement::class, mappedBy: 'paiement')]
    private Collection $modePaiements;

    public function __construct()
    {
        $this->reservation = new ArrayCollection();
        $this->modePaiements = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

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
            $reservation->setPaiement($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): static
    {
        if ($this->reservation->removeElement($reservation)) {
            // set the owning side to null (unless already changed)
            if ($reservation->getPaiement() === $this) {
                $reservation->setPaiement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, ModePaiement>
     */
    public function getModePaiements(): Collection
    {
        return $this->modePaiements;
    }

    public function addModePaiement(ModePaiement $modePaiement): static
    {
        if (!$this->modePaiements->contains($modePaiement)) {
            $this->modePaiements->add($modePaiement);
            $modePaiement->addPaiement($this);
        }

        return $this;
    }

    public function removeModePaiement(ModePaiement $modePaiement): static
    {
        if ($this->modePaiements->removeElement($modePaiement)) {
            $modePaiement->removePaiement($this);
        }

        return $this;
    }
}
