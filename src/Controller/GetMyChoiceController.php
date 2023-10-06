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

    public function __invoke(): \Doctrine\Common\Collections\Collection
    {
        if ($this->getUser()) {
            return $this->getUser()->getChoice();
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }
}
