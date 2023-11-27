<?php

namespace App\Controller;

use App\Repository\SemesterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetSemesterByYearController extends AbstractController
{
    private SemesterRepository $repository;

    public function __construct(SemesterRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke(string $id): array
    {
        $repository = $this->repository;

        return $repository->findSemesterByYear($id);
    }
}
