<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\TagRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ApiResource(paginationEnabled: false)]
class Tag
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups('get_SubjectBySemester')]
    private ?int $id = null;

    #[ORM\Column(length: 150)]
    #[Groups('get_SubjectBySemester')]
    private ?string $name = null;

    #[ORM\ManyToMany(targetEntity: Lesson::class, inversedBy: 'tags')]
    private Collection $lessons;

    public function __construct(
        string $name = null,
    ) {
        $this->name = $name;
        $this->lessons = new ArrayCollection();
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
     * @return Collection<int, Lesson>
     */
    public function getLessons(): Collection
    {
        return $this->lessons;
    }

    public function addLesson(Lesson $lesson): static
    {
        if (!$this->lessons->contains($lesson)) {
            $this->lessons->add($lesson);
        }

        return $this;
    }

    public function removeLesson(Lesson $lesson): static
    {
        $this->lessons->removeElement($lesson);

        return $this;
    }
}
