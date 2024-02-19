<?php

namespace App\Entity;

use App\Repository\PlaceMemoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceMemoRepository::class)]
class PlaceMemo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'placeMemos')]
    private ?user $user = null;

    #[ORM\ManyToOne(inversedBy: 'placeMemos')]
    private ?place $place = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $note = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $visited_date = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getPlace(): ?place
    {
        return $this->place;
    }

    public function setPlace(?place $place): static
    {
        $this->place = $place;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getVisitedDate(): ?\DateTimeInterface
    {
        return $this->visited_date;
    }

    public function setVisitedDate(?\DateTimeInterface $visited_date): static
    {
        $this->visited_date = $visited_date;

        return $this;
    }
}
