<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetTeacherController extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @throws NonUniqueResultException
     */
    public function __invoke(): array
    {
        $repository = $this->repository;
        $teachers = $repository->getTeachers();
        if ($teachers) {
            return $teachers;
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }
}
