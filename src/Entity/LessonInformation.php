<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\LessonInformationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: LessonInformationRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(
            normalizationContext: ['groups' => ['get_Information']],
        ),
    ],
)]
class LessonInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Choice', 'get_Lesson', 'get_Subject', 'get_Information', 'get_OldChoice'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get_Choice', 'get_Lesson', 'get_Subject', 'get_Information', 'get_OldChoice'])]
    private ?int $nbGroups = null;

    #[ORM\Column(length: 4, nullable: true)]
    #[Groups(['get_Information'])]
    private ?string $saeSupport = null;

    #[ORM\ManyToOne(inversedBy: 'lessonInformation')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Choice', 'get_Information', 'get_OldChoice'])]
    private ?Lesson $lesson = null;

    #[ORM\ManyToOne(inversedBy: 'lessonInformation')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Choice', 'get_Lesson', 'get_Subject', 'get_Information', 'get_OldChoice'])]
    private ?LessonType $lessonType = null;

    #[ORM\OneToMany(mappedBy: 'information', targetEntity: LessonPlanning::class, cascade: ['remove'])]
    #[Groups(['get_Choice','get_Information'])]
    private Collection $lessonPlannings;

    #[ORM\OneToMany(mappedBy: 'lessonInformation', targetEntity: Choice::class)]
    #[Groups(['get_Information'])]
    private Collection $choices;

    public function __construct(
        int $nbGroups = null,
        string $saeSupport = null,
        Lesson $lesson = null,
        LessonType $lessonType = null,
    ) {
        $this->lessonPlannings = new ArrayCollection();
        $this->choices = new ArrayCollection();

        $this->nbGroups = $nbGroups;
        $this->saeSupport = $saeSupport;
        $this->lesson = $lesson;
        $this->lessonType = $lessonType;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGroups(): ?int
    {
        return $this->nbGroups;
    }

    public function setNbGroups(int $nbGroups): static
    {
        $this->nbGroups = $nbGroups;

        return $this;
    }

    public function getSaeSupport(): ?string
    {
        return $this->saeSupport;
    }

    public function setSaeSupport(?string $saeSupport): static
    {
        $this->saeSupport = $saeSupport;

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->lesson;
    }

    public function setLesson(?Lesson $lesson): static
    {
        $this->lesson = $lesson;

        return $this;
    }

    public function getLessonType(): ?LessonType
    {
        return $this->lessonType;
    }

    public function setLessonType(?LessonType $lessonType): static
    {
        $this->lessonType = $lessonType;

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
            $lessonPlanning->setInformation($this);
        }

        return $this;
    }

    public function removeLessonPlanning(LessonPlanning $lessonPlanning): static
    {
        if ($this->lessonPlannings->removeElement($lessonPlanning)) {
            // set the owning side to null (unless already changed)
            if ($lessonPlanning->getInformation() === $this) {
                $lessonPlanning->setInformation(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Choice>
     */
    public function getChoices(): Collection
    {
        return $this->choices;
    }

    public function addChoice(Choice $choice): static
    {
        if (!$this->choices->contains($choice)) {
            $this->choices->add($choice);
            $choice->setLessonInformation($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): static
    {
        if ($this->choices->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getLessonInformation() === $this) {
                $choice->setLessonInformation(null);
            }
        }

        return $this;
    }
}
