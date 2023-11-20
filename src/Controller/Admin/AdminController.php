<?php

namespace App\Controller\Admin;

use App\Entity\Lesson;
use App\Entity\LessonInformation;
use App\Entity\LessonPlanning;
use App\Entity\LessonType;
use App\Entity\Semester;
use App\Entity\Status;
use App\Entity\Subject;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');
        $this->isGranted('ROLE_ADMIN');

        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('SetURCAlender');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-circle-user', User::class);
        yield MenuItem::linkToCrud('Status utilisateurs', 'fas fa-users', Status::class);
        yield MenuItem::linkToCrud('Cours', 'fas fa-book', Lesson::class);
        yield MenuItem::linkToCrud('Sujet', 'fas fa-book', Subject::class);
        yield MenuItem::linkToCrud('Informations des cours', 'fas fa-info', LessonInformation::class);
        yield MenuItem::linkToCrud('Heures des cours', 'fas fa-clock', LessonPlanning::class);
        yield MenuItem::linkToCrud('Type de cours', 'fas fa-list', LessonType::class);
        yield MenuItem::linkToCrud('Semestres', 'fas fa-calendar', Semester::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
