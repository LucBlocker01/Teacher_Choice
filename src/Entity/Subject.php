<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use App\Repository\SubjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectRepository::class)]
#[ApiResource]
#[Get(
    openapiContext: [
        'summary' => 'Finds the Subject with the given id',
        'responses' => [
            '200' => [
                'description' => 'The Subject have been found with the given id',
            ],
            '404' => [
                'description' => "The Subject didn't get found",
            ],
],
    ]
)]
#[GetCollection(
    openapiContext: [
        'summary' => 'Returns a collection of Subjects',
        'responses' => [
            '200' => [
                'description' => 'A collection of Subjects have been returned',
            ],
            '404' => [
                'description' => 'No collections have been found',
            ],
        ],
    ]
)]
#[Post(
    openapiContext: [
    'summary' => 'Adds a new Subject',
    'responses' => [
        '201' => [
            'description' => 'A new Subject has successfully been created',
        ],
        '403' => [
            'description' => 'You do not have the permission to create a Subject',
        ],
    ],
],
    security: "is_granted('ROLE_ADMIN') and object.getUser() == user"
)]
#[Delete(
    openapiContext: [
        'summary' => 'Deletes a Subject',
        'responses' => [
            '204' => [
                'description' => 'The Subject has successfully been deleted',
            ],
            '403' => [
                'description' => 'You do not have the permission to delete a Subject',
            ],
            '404' => [
                'description' => 'The Subject you tried to delete does not exist',
            ],
        ],
    ],
    security: "is_granted('ROLE_ADMIN') and object.getUser() == user"
)]
class Subject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

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

    #[ORM\OneToMany(mappedBy: 'subject', targetEntity: Slot::class)]
    private Collection $slots;

    #[ORM\ManyToOne(inversedBy: 'subjects')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Semester $semester = null;

    #[ORM\Column(length: 100)]
    private ?string $name = null;

    public function __construct()
    {
        $this->choices = new ArrayCollection();
        $this->slots = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection<int, Slot>
     */
    public function getSlots(): Collection
    {
        return $this->slots;
    }

    public function addSlot(Slot $slot): static
    {
        if (!$this->slots->contains($slot)) {
            $this->slots->add($slot);
            $slot->setSubject($this);
        }

        return $this;
    }

    public function removeSlot(Slot $slot): static
    {
        if ($this->slots->removeElement($slot)) {
            // set the owning side to null (unless already changed)
            if ($slot->getSubject() === $this) {
                $slot->setSubject(null);
            }
        }

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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
}
