<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\SlotRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SlotRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            openapiContext: [
                'summary' => 'Retrieve Slot informations by ID',
                'description' => 'Semester informations response',
                'responses' => [
                    '200' => [
                        'description' => 'informations for slot to be returned',
                    ],
                ],
            ],
            security: 'is_granted("ROLE_ADMIN")'
        ),
        new GetCollection(
            openapiContext: [
                'summary' => 'Retrieve Slots informations',
                'description' => 'Slot list informations response',
                'responses' => [
                    '200' => [
                        'description' => 'informations list for slots to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Post(
            openapiContext: [
                'summary' => 'Create a Slot Resource',
                'description' => 'Slot informations response',
                'responses' => [
                    '200' => [
                        'description' => 'new slot to be added',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Patch(
            openapiContext: [
                'summary' => 'Updates Slot informations with ID',
                'description' => 'Slot informations response',
                'responses' => [
                    '200' => [
                        'description' => 'new informations for slot to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Put(
            openapiContext: [
                'summary' => 'Replaces Slot informations by ID',
                'description' => 'Slot informations response',
                'responses' => [
                    '200' => [
                        'description' => 'new informations for slot to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Delete(
            openapiContext: [
                'summary' => 'Remove Slot informations with ID',
                'description' => 'Slot informations response',
                'responses' => [
                    '200' => [
                        'description' => 'slot deleted to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
        ),
    ]
)]
class Slot
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $week = null;

    #[ORM\Column]
    private ?float $nb_hours = null;

    #[ORM\ManyToOne(inversedBy: 'slots')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Subject $subject = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeek(): ?int
    {
        return $this->week;
    }

    public function setWeek(int $week): static
    {
        $this->week = $week;

        return $this;
    }

    public function getNbHours(): ?float
    {
        return $this->nb_hours;
    }

    public function setNbHours(float $nb_hours): static
    {
        $this->nb_hours = $nb_hours;

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
}
