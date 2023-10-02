<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\User\UserInterface;

class GetMeController extends AbstractController
{
    public function __invoke(): UserInterface
    {
        if ($this->getUser()) {
            return $this->getUser();
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }
}
