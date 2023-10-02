<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\LessonInformationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LessonInformationRepository::class)]
#[ApiResource]
class LessonInformation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nb_groups = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $SAESupport = null;

    #[ORM\ManyToOne(inversedBy: 'lessonInformation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Lesson $Lesson = null;

    #[ORM\ManyToOne(inversedBy: 'lessonInformation')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LessonType $LessonType = null;

    #[ORM\OneToMany(mappedBy: 'information', targetEntity: LessonPlanning::class)]
    private Collection $lessonPlannings;

    #[ORM\OneToMany(mappedBy: 'lessonInformation', targetEntity: Choice::class)]
    private Collection $choices;

    public function __construct()
    {
        $this->lessonPlannings = new ArrayCollection();
        $this->choices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGroups(): ?int
    {
        return $this->nb_groups;
    }

    public function setNbGroups(int $nb_groups): static
    {
        $this->nb_groups = $nb_groups;

        return $this;
    }

    public function getSAESupport(): ?string
    {
        return $this->SAESupport;
    }

    public function setSAESupport(?string $SAESupport): static
    {
        $this->SAESupport = $SAESupport;

        return $this;
    }

    public function getLesson(): ?Lesson
    {
        return $this->Lesson;
    }

    public function setLesson(?Lesson $Lesson): static
    {
        $this->Lesson = $Lesson;

        return $this;
    }

    public function getLessonType(): ?LessonType
    {
        return $this->LessonType;
    }

    public function setLessonType(?LessonType $LessonType): static
    {
        $this->LessonType = $LessonType;

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
