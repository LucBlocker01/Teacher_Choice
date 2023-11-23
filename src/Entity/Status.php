<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use App\Repository\StatusRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
    ]
)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Groups(['get_Me', 'get_User'])]
    #[ORM\Column(length: 40)]
    private ?string $name = null;

    #[Groups(['get_Me', 'get_User'])]
    #[ORM\Column(nullable: true)]
    private ?float $minHours = null;

    #[Groups(['get_Me', 'get_User'])]
    #[ORM\Column(nullable: true)]
    private ?float $maxHours = null;

    #[ORM\OneToMany(mappedBy: 'status', targetEntity: User::class)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
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

    public function getMinHours(): ?float
    {
        return $this->minHours;
    }

    public function setMinHours(?float $minHours): static
    {
        $this->minHours = $minHours;

        return $this;
    }

    public function getMaxHours(): ?float
    {
        return $this->maxHours;
    }

    public function setMaxHours(?float $maxHours): static
    {
        $this->maxHours = $maxHours;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setStatus($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getStatus() === $this) {
                $user->setStatus(null);
            }
        }

        return $this;
    }
}
