<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\WeekStatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: WeekStatusRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class WeekStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?bool $holiday = null;

    #[ORM\Column]
    private ?bool $work_study = null;

    #[ORM\Column]
    private ?bool $internship = null;

    #[ORM\ManyToOne(inversedBy: 'WeekStatus')]
    private ?Semester $semester = null;

    public function __construct()
    {
        $this->weeks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isHoliday(): ?bool
    {
        return $this->holiday;
    }

    public function setHoliday(bool $holiday): static
    {
        $this->holiday = $holiday;

        return $this;
    }

    public function isWorkStudy(): ?bool
    {
        return $this->work_study;
    }

    public function setWorkStudy(bool $work_study): static
    {
        $this->work_study = $work_study;

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

    /**
     * @return Collection<int, Week>
     */
    public function getWeeks(): Collection
    {
        return $this->weeks;
    }

    public function getSemester(): ?Semester
    {
        return $this->semester;
    }

    public function setSemester(?Semester $semester): static
    {
        $this->semester = $semester;

        return $this;
    }
}
