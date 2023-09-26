<?php

namespace App\Entity;

use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $semester = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\Column]
    private ?int $nb_group = null;

    #[ORM\Column(length: 4, nullable: true)]
    private ?string $SAE_support = null;

    #[ORM\ManyToOne(inversedBy: 'subjects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubjectType $type = null;

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Choice::class)]
    private Collection $choices;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSemester(): ?string
    {
        return $this->semester;
    }

    public function setSemester(string $semester): static
    {
        $this->semester = $semester;

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

    public function getNbGroup(): ?int
    {
        return $this->nb_group;
    }

    public function setNbGroup(int $nb_group): static
    {
        $this->nb_group = $nb_group;

        return $this;
    }

    public function getSAESupport(): ?string
    {
        return $this->SAE_support;
    }

    public function setSAESupport(?string $SAE_support): static
    {
        $this->SAE_support = $SAE_support;

        return $this;
    }

    public function getType(): ?SubjectType
    {
        return $this->type;
    }

    public function setType(?SubjectType $type): static
    {
        $this->type = $type;

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
            $choice->setSubject($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): static
    {
        if ($this->choices->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getSubject() === $this) {
                $choice->setSubject(null);
            }
        }

        return $this;
    }
}
