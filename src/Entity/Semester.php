<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\SemesterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SemesterRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            openapiContext: [
                'summary' => 'Retrieve Semester informations by ID',
                'description' => 'Semester informations response',
                'responses' => [
                    '200' => [
                        'description' => 'informations for semester to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Retrieve Semester list informations',
                'description' => 'Semester list informations response',
                'responses' => [
                    '200' => [
                        'description' => 'informations list for semester to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
        ),
    ]
)]
class Semester
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'semester', targetEntity: Subject::class)]
    private Collection $subjects;

    #[ORM\OneToMany(mappedBy: 'semester', targetEntity: WeekStatus::class)]
    private Collection $weekStatus;

    #[ORM\Column(length: 9)]
    private ?string $year = null;

    public function __construct(
        $name = null,
        $year = null,
    ) {
        $this->name = $name;
        $this->year = $year;
        $this->subjects = new ArrayCollection();
        $this->weekStatus = new ArrayCollection();
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

    /**
     * @return Collection<int, Subject>
     */
    public function getSubjects(): Collection
    {
        return $this->subjects;
    }

    public function addSubject(Subject $subject): static
    {
        if (!$this->subjects->contains($subject)) {
            $this->subjects->add($subject);
            $subject->setSemester($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): static
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getSemester() === $this) {
                $subject->setSemester(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, WeekStatus>
     */
    public function getWeekStatus(): Collection
    {
        return $this->weekStatus;
    }

    public function addWeekStatus(WeekStatus $weekStatus): static
    {
        if (!$this->weekStatus->contains($weekStatus)) {
            $this->weekStatus->add($weekStatus);
            $weekStatus->setSemester($this);
        }

        return $this;
    }

    public function removeWeekStatus(WeekStatus $weekStatus): static
    {
        if ($this->weekStatus->removeElement($weekStatus)) {
            // set the owning side to null (unless already changed)
            if ($weekStatus->getSemester() === $this) {
                $weekStatus->setSemester(null);
            }
        }

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(string $year): static
    {
        $this->year = $year;

        return $this;
    }
}
