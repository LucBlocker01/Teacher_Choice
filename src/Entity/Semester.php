<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SemesterRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemesterRepository::class)]
#[ApiResource]
class Semester
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $name = null;

    #[ORM\Column]
    private ?bool $internship = null;

    #[ORM\Column]
    private ?bool $alternance = null;

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

    public function isInternship(): ?bool
    {
        return $this->internship;
    }

    public function setInternship(bool $internship): static
    {
        $this->internship = $internship;

        return $this;
    }

    public function isAlternance(): ?bool
    {
        return $this->alternance;
    }

    public function setAlternance(bool $alternance): static
    {
        $this->alternance = $alternance;

        return $this;
    }
}
