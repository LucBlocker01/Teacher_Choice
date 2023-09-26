<?php

namespace App\DataFixtures;

use App\Factory\StatusFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StatusFactory::createOne(['name' => 'Admin']);
        StatusFactory::createOne(['name' => 'Vacataire', 'max_hours' => 100]);
        StatusFactory::createOne(['name' => 'Enseignant', 'max_hours' => 300, 'min_hours' => 150]);
    }
}
