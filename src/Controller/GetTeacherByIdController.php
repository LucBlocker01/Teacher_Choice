<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class GetTeacherByIdController extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): UserInterface
    {
        $repository = $this->repository;
        $teacher = $repository->teacherById($id);
        if ($teacher) {
            return $teacher;
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }
}
