<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GetHoursPerChoiceController extends AbstractController
{
    #[Route('/get/hours/per/choice', name: 'app_get_hours_per_choice')]
    public function index(): Response
    {
        return $this->render('get_hours_per_choice/index.html.twig', [
            'controller_name' => 'GetHoursPerChoiceController',
        ]);
    }
}
