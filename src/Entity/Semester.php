<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
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
        ),
        new Post(
            openapiContext: [
                'summary' => 'Modify Semester informations with ID',
                'description' => 'Semester informations response',
                'responses' => [
                    '200' => [
                        'description' => 'new informations for semester to be returned',
                    ],
                ],
            ],
        ),
        new Patch(
            openapiContext: [
                'summary' => 'Modify Semester informations with ID',
                'description' => 'Semester informations response',
                'responses' => [
                    '200' => [
                        'description' => 'new informations for semester to be returned',
                    ],
                ],
            ],
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

    #[ORM\Column]
    private ?bool $internship = null;

    #[ORM\Column]
    private ?bool $alternance = null;

    #[ORM\OneToMany(mappedBy: 'semester', targetEntity: Subject::class)]
    private Collection $subjects;

    public function __construct()
    {
        $this->subjects = new ArrayCollection();
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

    public function isInternship(): ?bool
    {
        return $this->internship;
    }

    public function setInternship(bool $internship): static
    {
        $this->internship = $internship;

        return $this;
    }

    public function isAlternance(): ?bool
    {
        return $this->alternance;
    }

    public function setAlternance(bool $alternance): static
    {
        $this->alternance = $alternance;

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
}
