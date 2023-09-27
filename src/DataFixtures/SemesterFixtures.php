<?php

namespace App\DataFixtures;

use App\Factory\SemesterFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SemesterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SemesterFactory::createOne(['name' => 'S1', 'internship' => false, 'alternance' => false]);
        SemesterFactory::createOne(['name' => 'S2', 'internship' => false, 'alternance' => false]);
        SemesterFactory::createOne(['name' => 'S3', 'internship' => false, 'alternance' => false]);
        SemesterFactory::createOne(['name' => 'S4', 'internship' => true, 'alternance' => false]);
        SemesterFactory::createOne(['name' => 'S5', 'internship' => false, 'alternance' => true]);
        SemesterFactory::createOne(['name' => 'S6', 'internship' => true, 'alternance' => true]);
    }
}
