<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
#[ApiResource]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $status_id = null;

    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\Column(nullable: true)]
    private ?float $min_hours = null;

    #[ORM\Column(nullable: true)]
    private ?float $max_hours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatusId(): ?int
    {
        return $this->status_id;
    }

    public function setStatusId(int $status_id): static
    {
        $this->status_id = $status_id;

        return $this;
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

    public function getMinHours(): ?float
    {
        return $this->min_hours;
    }

    public function setMinHours(?float $min_hours): static
    {
        $this->min_hours = $min_hours;

        return $this;
    }

    public function getMaxHours(): ?float
    {
        return $this->max_hours;
    }

    public function setMaxHours(?float $max_hours): static
    {
        $this->max_hours = $max_hours;

        return $this;
    }
}
