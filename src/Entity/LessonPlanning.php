<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\LessonPlanningRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonPlanningRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class LessonPlanning
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbHours = null;

    #[ORM\ManyToOne(inversedBy: 'lessonPlannings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LessonInformation $information = null;

    #[ORM\ManyToOne(inversedBy: 'lessonPlannings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?WeekStatus $weekStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbHours(): ?int
    {
        return $this->nbHours;
    }

    public function setNbHours(int $nbHours): static
    {
        $this->nbHours = $nbHours;

        return $this;
    }

    public function getInformation(): ?LessonInformation
    {
        return $this->information;
    }

    public function setInformation(?LessonInformation $information): static
    {
        $this->information = $information;

        return $this;
    }

    public function getWeekStatus(): ?WeekStatus
    {
        return $this->weekStatus;
    }

    public function setWeekStatus(?WeekStatus $weekStatus): static
    {
        $this->weekStatus = $weekStatus;

        return $this;
    }
}
