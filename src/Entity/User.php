<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Controller\GetMeController;
use App\Controller\GetTeacherByIdController;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints\Regex;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new Get(
        ),
        new GetCollection(
            uriTemplate: '/me',
            controller: GetMeController::class,
            openapiContext: [
                'summary' => 'get information from connected user',
                'description' => 'Enter the login, first name, last name and email of the connected user',
                'responses' => [
                    '200' => [
                        'description' => 'User logged in',
                    ],
                    '401' => [
                        'description' => 'User not logged in',
                    ],
                ],
            ],
            paginationEnabled: false,
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            security: "is_granted('ROLE_USER')"
        ),
        new Put(
            normalizationContext: ['groups' => ['get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user",
        ),
        new Patch(
            normalizationContext: ['groups' => ['get_User']],
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user",
        ),
        new GetCollection(
            uriTemplate: '/teacher/{id}',
            controller: GetTeacherByIdController::class,
            openapiContext: [
                'summary' => 'get teacher by id',
                'description' => 'Get the teacher by him id',
                'responses' => [
                    '200' => [
                        'description' => 'Teacher :',
                    ],
                    '404' => [
                        'description' => 'User not found',
                    ],
                ],
            ],
            security: "is_granted('ROLE_ADMIN')",
        ),
    ],
    normalizationContext: ['groups' => ['get_User']],
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_User'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['get_User', 'set_User', 'get_Me'])]
    #[Regex(
        pattern: '/[<>&"]/',
        message: 'Your login cannot use this character : <>&"',
        match: false
    )]
    private ?string $login = null;

    #[ORM\Column]
    #[Groups(['get_Me', 'get_User'])]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['set_User'])]
    private ?string $password = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['get_Me', 'get_User'])]
    private ?Status $status = null;

    #[ORM\OneToMany(mappedBy: 'teacher', targetEntity: Choice::class)]
    private Collection $choice;

    #[ORM\Column(length: 40)]
    #[Groups(['get_User', 'set_User', 'get_Me'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 40)]
    #[Groups(['get_User', 'set_User', 'get_Me'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 100)]
    #[Groups(['set_User', 'get_Me'])]
    private ?string $mail = null;

    #[ORM\Column(length: 20)]
    #[Groups(['set_User', 'get_Me'])]
    private ?string $phone = null;

    #[ORM\Column(length: 5, nullable: true)]
    #[Groups(['set_User', 'get_Me'])]
    private ?string $postcode = null;

    #[ORM\Column(length: 40, nullable: true)]
    #[Groups(['set_User', 'get_Me'])]
    private ?string $city = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups(['set_User', 'get_Me'])]
    private ?string $address = null;

    public function __construct()
    {
        $this->choice = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection<int, Choice>
     */
    public function getChoice(): Collection
    {
        return $this->choice;
    }

    public function addChoice(Choice $choice): static
    {
        if (!$this->choice->contains($choice)) {
            $this->choice->add($choice);
            $choice->setTeacher($this);
        }

        return $this;
    }

    public function removeChoice(Choice $choice): static
    {
        if ($this->choice->removeElement($choice)) {
            // set the owning side to null (unless already changed)
            if ($choice->getTeacher() === $this) {
                $choice->setTeacher(null);
            }
        }

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): static
    {
        $this->mail = $mail;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPostcode(): ?string
    {
        return $this->postcode;
    }

    public function setPostcode(?string $postcode): static
    {
        $this->postcode = $postcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(?string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }
}
