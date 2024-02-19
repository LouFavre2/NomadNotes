<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: 'float', precision: 10, scale: 8)]
    private ?float $latitude = null;

    #[ORM\Column(type: 'float', precision: 10, scale: 8)]
    private ?float $longitude = null;

    #[ORM\OneToMany(targetEntity: PlaceMemo::class, mappedBy: 'place')]
    private Collection $placeMemos;

    public function __construct()
    {
        $this->placeMemos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * @return Collection<int, PlaceMemo>
     */
    public function getPlaceMemos(): Collection
    {
        return $this->placeMemos;
    }

    public function addPlaceMemo(PlaceMemo $placeMemo): static
    {
        if (!$this->placeMemos->contains($placeMemo)) {
            $this->placeMemos->add($placeMemo);
            $placeMemo->setPlace($this);
        }

        return $this;
    }

    public function removePlaceMemo(PlaceMemo $placeMemo): static
    {
        if ($this->placeMemos->removeElement($placeMemo)) {
            // set the owning side to null (unless already changed)
            if ($placeMemo->getPlace() === $this) {
                $placeMemo->setPlace(null);
            }
        }

        return $this;
    }
}
