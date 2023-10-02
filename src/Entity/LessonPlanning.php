<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LessonPlanningRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonPlanningRepository::class)]
#[ApiResource]
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
    private ?Week $week = null;

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

    public function getWeek(): ?Week
    {
        return $this->week;
    }

    public function setWeek(?Week $week): static
    {
        $this->week = $week;

        return $this;
    }
}
