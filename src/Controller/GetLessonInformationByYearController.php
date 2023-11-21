<?php

namespace App\Controller;

use App\Repository\LessonInformationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class GetLessonInformationByYearController extends AbstractController
{
    private LessonInformationRepository $lessonInformationRepository;

    public function __construct(LessonInformationRepository $repository)
    {
        $this->lessonInformationRepository = $repository;
    }

    public function __invoke(string $year): Response
    {
        $repository = $this->lessonInformationRepository;

        return $repository->getLessonInformationByYear($year);
    }
}
