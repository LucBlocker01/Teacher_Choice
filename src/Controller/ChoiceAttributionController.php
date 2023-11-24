<?php

namespace App\Controller;

use App\Entity\Choice;
use App\Repository\LessonInformationRepository;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceAttributionController extends AbstractController
{
    #[Route('/attribution', name: 'app_attribution')]
    public function index(LessonInformationRepository $repository): Response
    {
        $lessons = $repository->getLessonByCurrentYear();

        return $this->render('choice_attribution/index.html.twig', [
            'lessons' => $lessons,
        ]);
    }

    #[Route('/attribution/change/{id}', name: 'app_attribution_change', requirements: ['id' => '\d+'])]
    public function attributed(#[MapEntity(expr: 'repository.findBy(id)')] Choice $Choice): Response
    {
        return $this->redirectToRoute('app_home');
    }
}
