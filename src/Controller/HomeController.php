<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/react.html.twig');
    }

    #[Route('/react', name: 'app_react')]
    #[Route('/react/choices', 'app_react_choices')]
    #[Route('/react/choices/add', 'app_react_choices_add')]
    #[Route('/react/admin', 'app_react_admin')]
    #[IsGranted('ROLE_USER')]
    public function react(): Response
    {
        return $this->render('home/react.html.twig');
    }
}
