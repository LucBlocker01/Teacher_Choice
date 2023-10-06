<?php

namespace App\Controller;

use App\Repository\ChoiceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetPlanningsPerChoiceController extends AbstractController
{
    private ChoiceRepository $repository;

    public function __construct(ChoiceRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(int $id): \Doctrine\Common\Collections\Collection
    {
        $repository = $this->repository;
        $choices = $repository->find($id);
        $plannings = $choices->getLessonInformation()->getLessonPlannings();
        if ($plannings) {
            return $plannings;
        } else {
            throw $this->createNotFoundException('');
        }
    }
}
