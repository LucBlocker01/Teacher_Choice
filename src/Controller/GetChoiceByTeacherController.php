<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetChoiceByTeacherController extends AbstractController
{
    private UserRepository $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): \Doctrine\Common\Collections\Collection
    {
        $repository = $this->repository;
        $teacher = $repository->find($id);
        if ($teacher) {
            return $teacher->getChoice();
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }
}
