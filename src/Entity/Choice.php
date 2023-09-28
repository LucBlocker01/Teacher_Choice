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
        new Get(),
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
        ),
        new GetCollection(),
        new Post(),
        new Put(),
        new Patch(),
        new Delete(),
        ]
)]
class Choice
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nb_group_selected = null;

    #[ORM\Column(length: 4)]
    private ?string $year = null;

    #[ORM\ManyToOne(inversedBy: 'choices')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subject $subject = null;

    #[ORM\ManyToOne(inversedBy: 'choice')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $teacher = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGroupSelected(): ?int
    {
        return $this->nb_group_selected;
    }

    public function setNbGroupSelected(int $nb_group_selected): static
    {
        $this->nb_group_selected = $nb_group_selected;

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

    public function getSubject(): ?Subject
    {
        return $this->subject;
    }

    public function setSubject(?Subject $subject): static
    {
        $this->subject = $subject;

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
}
