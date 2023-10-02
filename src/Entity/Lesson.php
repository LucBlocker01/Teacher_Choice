<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ],
)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Subject::class, inversedBy: 'lessons')]
    private Collection $subjects;

    #[ORM\OneToMany(mappedBy: 'Lesson', targetEntity: LessonInformation::class)]
    private Collection $lessonInformation;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
        $this->lessonInformation = new ArrayCollection();
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
        }

        return $this;
    }

    public function removeSubject(Subject $subject): static
    {
        $this->subjects->removeElement($subject);

        return $this;
    }

    /**
     * @return Collection<int, LessonInformation>
     */
    public function getLessonInformation(): Collection
    {
        return $this->lessonInformation;
    }

    public function addLessonInformation(LessonInformation $lessonInformation): static
    {
        if (!$this->lessonInformation->contains($lessonInformation)) {
            $this->lessonInformation->add($lessonInformation);
            $lessonInformation->setLesson($this);
        }

        return $this;
    }

    public function removeLessonInformation(LessonInformation $lessonInformation): static
    {
        if ($this->lessonInformation->removeElement($lessonInformation)) {
            // set the owning side to null (unless already changed)
            if ($lessonInformation->getLesson() === $this) {
                $lessonInformation->setLesson(null);
            }
        }

        return $this;
    }
}
