<?php

namespace App\Controller;

use App\Repository\LessonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceAttributionController extends AbstractController
{
    #[Route('/attribution', name: 'app_choice_attribution')]
    public function index(LessonRepository $repository): Response
    {
        $lessons = $repository->findAll();

        return $this->render('choice_attribution/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }
}
