<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\SubjectTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubjectTypeRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            openapiContext: [
                'summary' => 'Find the SubjectType with the ID',
                'responses' => [
                    '200' => [
                        'description' => 'The SubjectType has been return.',
                    ],
                    '401' => [
                        'description' => 'No permission.',
                    ],
                    '404' => [
                        'description' => 'No SubjectType find.',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')"
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Find all SubjectType',
                'responses' => [
                    '200' => [
                        'description' => 'All SubjectType has been return.',
                    ],
                    '401' => [
                        'description' => 'No permission.',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')"
        ),
    ]
)]
class SubjectType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'type', targetEntity: Subject::class)]
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
            $subject->setType($this);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): static
    {
        if ($this->subjects->removeElement($subject)) {
            // set the owning side to null (unless already changed)
            if ($subject->getType() === $this) {
                $subject->setType(null);
            }
        }

        return $this;
    }
}
