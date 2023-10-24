<?php

namespace App\Controller;

use App\Repository\ChoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetMyChoiceController extends AbstractController
{
    private ChoiceRepository $repository;

    public function __construct(ChoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        if ($this->getUser()) {
            // return $this->getUser()->getChoice();
            $user = $this->getUser();

            return $this->repository->getChoiceInformations($user->getId());
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }
}
