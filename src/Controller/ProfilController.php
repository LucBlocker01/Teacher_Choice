<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil/{id}', name: 'app_profil_show', requirements: ['id' => '\d+'])]
    public function show(User $user): Response
    {
        $connectedUser = $this->getUser();
        // security, if user is not connected, redirect to login page
        if (null === $connectedUser) {
            return $this->redirectToRoute('app_login');
        } elseif ($user->getId() !== $connectedUser->getId()) {
            // if user is not the same as the connected user, redirect to his profil page
            return $this->redirectToRoute('app_profil_show', ['id' => $this->getUser()->getId()]);
        }

        return $this->render('profil/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/profil/{id}/edit', name: 'app_profil_edit', requirements: ['id' => '\d+'])]
    public function edit(ManagerRegistry $doctrine, UserRepository $repository, Request $request): Response
    {
        $user = $repository->find($request->get('id'));
        $form = $this->createForm(UserType::class, $user);

        $manager = $doctrine->getManager();

        $form->handleRequest($request);

        $connectedUser = $this->getUser();
        // security, if user is not connected, redirect to login page
        if (null === $connectedUser) {
            return $this->redirectToRoute('app_login');
        } elseif ($user->getId() !== $connectedUser->getId()) {
            // if user is not the same as the connected user, redirect to his profil page
            return $this->redirectToRoute('app_profil_show', ['id' => $this->getUser()->getId()]);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('app_profil_show', ['id' => $user->getId()]);
        }

        return $this->render('profil/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
