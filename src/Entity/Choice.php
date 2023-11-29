<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\GetChoiceByTeacherController;
use App\Controller\GetMyChoiceController;
use App\Controller\GetOldChoicesController;
use App\Repository\ChoiceRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ChoiceRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object.getTeacher() == user",
        ),
        new GetCollection(
            uriTemplate: '/choice/me',
            controller: GetMyChoiceController::class,
            openapiContext: [
                'summary' => 'get your own choice',
                'description' => 'Will return all choices of the connected user',
                'responses' => [
                    '200' => [
                        'description' => 'User logged in & choices found',
                    ],
                ],
            ],
            normalizationContext: ['groups' => ['get_Choice']],
            security: "is_granted('ROLE_USER')",
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
            normalizationContext: ['groups' => ['get_Choice']],
            security: "is_granted('ROLE_ADMIN')",
        ),
        new GetCollection(uriTemplate: '/old_choices',
            controller: GetOldChoicesController::class,
            openapiContext: [
                'summary' => 'Retrieve old choices of connected user',
                'description' => 'Old choices list response',
                'responses' => [
                    '200' => [
                        'description' => 'Old choices list to be returned',
                    ],
                ],
            ],
            normalizationContext: ['groups' => ['get_User', 'get_OldChoice']],
            security: "is_granted('ROLE_USER')",
        ),
        new GetCollection(
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object == user",
        ),
        new Post(
            normalizationContext: ['groups' => ['post_Choice']],
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
        ),
        new Patch(
            normalizationContext: ['groups' => ['patch_Choice_Admin', 'patch_Choice_User']],
            security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_USER') and object.getTeacher() == user",
        ),
        new Delete(
            security: "is_granted('ROLE_USER') and object.getTeacher() == user",
        ),
        ]
)]
class Choice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Choice', 'post_Choice', 'get_OldChoice', 'get_Information'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get_Choice', 'post_Choice', 'get_OldChoice', 'get_Information'])]
    private ?int $nbGroupSelected = null;

    #[ORM\ManyToOne(inversedBy: 'choice')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Choice', 'post_Choice', 'get_Information'])]
    private ?User $teacher = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get_Choice', 'get_OldChoice', 'get_Information'])]
    private ?int $nbGroupAttributed = null;

    #[ORM\ManyToOne(inversedBy: 'choices')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Choice', 'post_Choice', 'get_OldChoice'])]
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
