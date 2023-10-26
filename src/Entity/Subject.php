<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetSubjectBySemesterController;
use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
        ),
        new GetCollection(
            uriTemplate: '/subjects/semester/{id}',
            controller: GetSubjectBySemesterController::class,
            openapiContext: [
                'summary' => 'get subject from a given semester',
                'description' => 'Will return all subject of the semester given',
            ],
            normalizationContext: ['groups' => ['get_SubjectBySemester']],
        ),
        new GetCollection(
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
        ),
    ]
)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_SubjectBySemester'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['get_Choice', 'get_SubjectBySemester'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'subjects')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Choice'])]
    private ?Semester $semester = null;

    #[ORM\Column(length: 1, nullable: true)]
    private ?string $speciality = null;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Lesson::class)]
    #[Groups(['get_SubjectBySemester'])]
    private Collection $lessons;

    public function __construct(
        string $name = null,
        Semester $semester = null,
        string $speciality = null,
    ) {
        $this->name = $name;
        $this->semester = $semester;
        $this->speciality = $speciality;
        $this->lessons = new ArrayCollection();
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

    public function getSemester(): ?Semester
    {
        return $this->semester;
    }

    public function setSemester(?Semester $semester): static
    {
        $this->semester = $semester;

        return $this;
    }

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(?string $speciality): static
    {
        $this->speciality = $speciality;

        return $this;
    }

    /**
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): static
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
            $lesson->setSubject($this);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        if ($this->lessons->removeElement($lesson)) {
            // set the owning side to null (unless already changed)
            if ($lesson->getSubject() === $this) {
                $lesson->setSubject(null);
            }
        }

        return $this;
    }
}
