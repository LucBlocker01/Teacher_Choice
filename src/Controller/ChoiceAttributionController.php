<?php

namespace App\Controller;

use App\Entity\Choice;
use App\Entity\LessonInformation;
use App\Entity\Semester;
use App\Form\AddTeacherToAChoiceType;
use App\Repository\ChoiceRepository;
use App\Repository\LessonInformationRepository;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ChoiceAttributionController extends AbstractController
{
    #[Route('/attribution', name: 'app_attribution')]
    #[IsGranted('ROLE_ADMIN')]
    public function home(): Response
    {
        return $this->redirectToRoute('app_attribution_semester', ['id' => '1']);
    }

    #[Route('/attribution/{id}', name: 'app_attribution_semester')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(LessonInformationRepository $repository, #[MapEntity(expr: 'repository.find(id)')] Semester $semester): Response
    {
        $lessons = $repository->getLessonBySemester($semester);

        return $this->render('choice_attribution/index.html.twig', [
            'lessons' => $lessons, 'semester' => $semester,
        ]);
    }

    #[Route('/attribution/change/{id}', name: 'app_attribution_change', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_ADMIN')]
    public function attributed(ChoiceRepository $choiceRepository, Request $request, ManagerRegistry $doctrine): Response
    {
        $manager = $doctrine->getManager();
        $nbGroups = $request->get('groupAttributed');
        if (0 !== $nbGroups) {
            $choice = $choiceRepository->find($request->get('id'));
            $choice->setNbGroupAttributed($nbGroups);
            $manager->flush();
        }

        return $this->redirect($request->headers->get('referer'));
    }

    #[Route('attribution/add/{id}', name: 'app_attribution_add', requirements: ['id' => '\d+'])]
    #[IsGranted('ROLE_ADMIN')]
    public function addTeacher(#[MapEntity(expr: 'repository.find(id)')] LessonInformation $lessonInformation, Request $request, ManagerRegistry $doctrine, UserRepository $userRepository): Response
    {
        $manager = $doctrine->getManager();
        $choice = new Choice();
        $choice->setLessonInformation($lessonInformation);
        $form = $this->createForm(AddTeacherToAChoiceType::class, $choice);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($form->getData());
            $manager->flush();

            return $this->redirectToRoute('app_attribution');
        }
        $teachers = $userRepository->getTeachers();

        return $this->render('choice_attribution/addTeacher.html.twig', ['form' => $form, 'lesson' => $lessonInformation, 'teachers' => $teachers, 'choice' => $choice]);
    }
}
