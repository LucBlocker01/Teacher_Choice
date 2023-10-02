<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Controller\GetChoiceByTeacherController;
use App\Repository\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChoiceRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new GetCollection(
            uriTemplate: '/user/choice/{id}',
            controller: GetChoiceByTeacherController::class,
            openapiContext: [
                'summary' => 'get choice from teacher',
                'description' => 'Put the teacher id to get his choices',
                'responses' => [
                    '200' => [
                        'description' => 'Choice of the teacher',
                    ],
                    '404' => [
                        'description' => 'User not found',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new GetCollection(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new Post(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new Put(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new Patch(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new Delete(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        ]
)]
class Choice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbGroupSelected = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\ManyToOne(inversedBy: 'choice')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $teacher = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbGroupAttributed = null;

    #[ORM\ManyToOne(inversedBy: 'choices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?LessonInformation $lessonInformation = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGroupSelected(): ?int
    {
        return $this->nbGroupSelected;
    }

    public function setNbGroupSelected(int $nbGroupSelected): static
    {
        $this->nbGroupSelected = $nbGroupSelected;

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

    public function getTeacher(): ?User
    {
        return $this->teacher;
    }

    public function setTeacher(?User $teacher): static
    {
        $this->teacher = $teacher;

        return $this;
    }

    public function getNbGroupAttributed(): ?int
    {
        return $this->nbGroupAttributed;
    }

    public function setNbGroupAttributed(?int $nbGroupAttributed): static
    {
        $this->nbGroupAttributed = $nbGroupAttributed;

        return $this;
    }

    public function getLessonInformation(): ?LessonInformation
    {
        return $this->lessonInformation;
    }

    public function setLessonInformation(?LessonInformation $lessonInformation): static
    {
        $this->lessonInformation = $lessonInformation;

        return $this;
    }
}
