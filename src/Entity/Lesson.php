<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Controller\GetLessonBySubjectController;
use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LessonRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(
            uriTemplate: '/lessons/subject/{id}',
            controller: GetLessonBySubjectController::class,
            openapiContext: [
                'summary' => 'get lessons from a given subject',
                'description' => 'Will return all lessons of the subject given',
            ],
            normalizationContext: ['groups' => ['get_Lesson']],
            security: "is_granted('ROLE_USER')",
        ),
        new GetCollection(),
    ],
)]
class Lesson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Lesson'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['get_Choice', 'get_Lesson', 'get_SubjectBySemester'])]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'lesson', targetEntity: LessonInformation::class)]
    #[Groups(['get_Lesson'])]
    private Collection $lessonInformation;

    #[ORM\ManyToOne(inversedBy: 'lessons')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Choice'])]
    private ?Subject $subject = null;

    #[ORM\ManyToMany(targetEntity: Tag::class, mappedBy: 'lessons')]
    #[Groups('get_SubjectBySemester')]
    private Collection $tags;

    public function __construct(
        string $name = null,
        Subject $subject = null,
    ) {
        $this->lessonInformation = new ArrayCollection();

        $this->name = $name;
        $this->subject = $subject;
        $this->tags = new ArrayCollection();
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

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * @return Collection<int, Tag>
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
            $tag->addLesson($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeLesson($this);
        }

        return $this;
    }
}
