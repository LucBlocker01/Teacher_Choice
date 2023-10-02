<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Repository\SemesterRepository;
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
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
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
            security: "is_granted('ROLE_USER') or is_granted('ROLE_ADMIN')",
        ),
        new Put(
            openapiContext: [
                'summary' => 'Replaces Semester informations with ID',
                'description' => 'Semester informations response',
                'responses' => [
                    '200' => [
                        'description' => 'new informations for semester to be returned',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
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
            security: "is_granted('ROLE_ADMIN')",
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
    private ?int $year = null;

    public function __construct()
    {
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

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): static
    {
        $this->year = $year;

        return $this;
    }
}
