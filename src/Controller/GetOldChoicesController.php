<?php

namespace App\Controller;

use App\Repository\ChoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetOldChoicesController extends AbstractController
{
    private ChoiceRepository $repository;

    public function __construct(ChoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(): array
    {
        $repository = $this->repository;

        return $repository->getOldChoices($this->getUser());
    }
}
