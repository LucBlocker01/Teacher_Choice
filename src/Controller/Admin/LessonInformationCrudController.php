<?php

namespace App\Controller\Admin;

use App\Entity\LessonInformation;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LessonInformationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return LessonInformation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('nb_groups'),
            TextField::new('sae_support'),
        ];
    }
}
