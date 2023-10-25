<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    #[IsGranted('ROLE_USER')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/react', name: 'app_react')]
    #[Route('/react/choices', 'app_react_choices')]
    #[Route('/react/choices/add', 'app_react_choices_add')]
    #[IsGranted('ROLE_USER')]
    public function react(): Response
    {
        return $this->render('home/react.html.twig');
    }
}
