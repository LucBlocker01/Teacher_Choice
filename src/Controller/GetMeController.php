<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class GetMeController extends AbstractController
{
    public function __invoke(): User
    {
        if ($this->getUser()) {
            return $this->getUser();
        } else {
            throw $this->createNotFoundException('Aucun utilisateur trouvé');
        }
    }

}
