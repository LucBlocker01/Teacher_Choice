<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\WeekRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WeekRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(paginationEnabled: false),
    ]
)]
class Week
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get_Choice'])]
    private ?int $weekNum = null;

    #[ORM\OneToMany(mappedBy: 'week', targetEntity: WeekStatus::class)]
    private Collection $weeksStatus;

    #[ORM\OneToMany(mappedBy: 'week', targetEntity: LessonPlanning::class)]
    private Collection $lessonPlannings;

    public function __construct()
    {
        $this->weeksStatus = new ArrayCollection();
        $this->lessonPlannings = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, WeekStatus>
     */
    public function getWeeksStatus(): Collection
    {
        return $this->weeksStatus;
    }

    public function addWeeksStatus(WeekStatus $weeksStatus): static
    {
        if (!$this->weeksStatus->contains($weeksStatus)) {
            $this->weeksStatus->add($weeksStatus);
            $weeksStatus->setWeek($this);
        }

        return $this;
    }

    public function removeWeeksStatus(WeekStatus $weeksStatus): static
    {
        if ($this->weeksStatus->removeElement($weeksStatus)) {
            // set the owning side to null (unless already changed)
            if ($weeksStatus->getWeek() === $this) {
                $weeksStatus->setWeek(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, LessonPlanning>
     */
    public function getLessonPlannings(): Collection
    {
        return $this->lessonPlannings;
    }

    public function addLessonPlanning(LessonPlanning $lessonPlanning): static
    {
        if (!$this->lessonPlannings->contains($lessonPlanning)) {
            $this->lessonPlannings->add($lessonPlanning);
            $lessonPlanning->setWeek($this);
        }

        return $this;
    }

    public function removeLessonPlanning(LessonPlanning $lessonPlanning): static
    {
        if ($this->lessonPlannings->removeElement($lessonPlanning)) {
            // set the owning side to null (unless already changed)
            if ($lessonPlanning->getWeek() === $this) {
                $lessonPlanning->setWeek(null);
            }
        }

        return $this;
    }
}
