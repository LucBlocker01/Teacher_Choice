<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\WeekRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeekRepository::class)]
#[ApiResource]
class Week
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $weekNum = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeekNum(): ?int
    {
        return $this->weekNum;
    }

    public function setWeekNum(int $weekNum): static
    {
        $this->weekNum = $weekNum;

        return $this;
    }
}
