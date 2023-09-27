<?php

namespace App\DataFixtures;

use App\Factory\StatusFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

use function Zenstruck\Foundry\faker;

class StatusFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        StatusFactory::createOne(['name' => 'Admin']);
        StatusFactory::createOne(['name' => 'Vacataire', 'max_hours' => faker()->numberBetween(100, 200)]);
        StatusFactory::createOne(['name' => 'Enseignant PRAG', 'max_hours' => 768, 'min_hours' => 384]);
        StatusFactory::createOne(['name' => 'Enseignant Chercheur', 'max_hours' => 384, 'min_hours' => 192]);
    }
}
