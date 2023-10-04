<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
