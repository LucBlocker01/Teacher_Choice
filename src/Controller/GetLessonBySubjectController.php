<?php

namespace App\Controller;

use App\Repository\SubjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GetLessonBySubjectController extends AbstractController
{
    private SubjectRepository $subjectRepository;

    public function __construct(SubjectRepository $repository)
    {
        $this->subjectRepository = $repository;
    }

    public function __invoke($id): \Doctrine\Common\Collections\Collection
    {
        $repository = $this->subjectRepository;
        $subject = $repository->find($id);

        return $subject->getLessons();
    }
}
