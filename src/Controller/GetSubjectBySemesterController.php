<?php

namespace App\Controller;

use App\Repository\SemesterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetSubjectBySemesterController extends AbstractController
{
    private SemesterRepository $semesterRepository;

    public function __construct(SemesterRepository $repository)
    {
        $this->semesterRepository = $repository;
    }

    public function __invoke(int $id)
    {
        $repository = $this->semesterRepository;
        $semester = $repository->find($id);

        return $semester->getSubjects();
    }
}
