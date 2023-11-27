<?php

namespace App\Controller;

use App\Repository\ChoiceRepository;
use App\Repository\LessonInformationRepository;
use App\Repository\SemesterRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoiceAttributionController extends AbstractController
{
    #[Route('/attribution', name: 'app_attribution')]
    public function home(): Response
    {
        return $this->redirectToRoute('app_attribution_semester', ['id' => '1']);
    }

    #[Route('/attribution/{id}', name: 'app_attribution_semester')]
    public function index(LessonInformationRepository $repository, Request $request, SemesterRepository $semesterRepository): Response
    {
        $semester = $semesterRepository->find($request->get('id'));
        $lessons = $repository->getLessonBySemester($semester);

        return $this->render('choice_attribution/index.html.twig', [
            'lessons' => $lessons, 'semester' => $semester,
        ]);
    }

    #[Route('/attribution/change/{id}', name: 'app_attribution_change', requirements: ['id' => '\d+'])]
    public function attributed(ChoiceRepository $choiceRepository, Request $request, ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
        $nbGroups = $request->get('groupAttributed');
        if (0 !== $nbGroups) {
            $choice = $choiceRepository->find($request->get('id'));
            $choice->setNbGroupAttributed($nbGroups);
            $manager->flush();
        }

        return $this->redirectToRoute('app_attribution');
    }
}
