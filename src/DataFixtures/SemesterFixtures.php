<?php

namespace App\DataFixtures;

use App\Factory\SemesterFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SemesterFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SemesterFactory::createOne(['name' => 'S1', 'year' => 2023]);
        SemesterFactory::createOne(['name' => 'S2', 'year' => 2023]);
        SemesterFactory::createOne(['name' => 'S3', 'year' => 2023]);
        SemesterFactory::createOne(['name' => 'S4', 'year' => 2023]);
        SemesterFactory::createOne(['name' => 'S5', 'year' => 2023]);
        SemesterFactory::createOne(['name' => 'S6', 'year' => 2023]);
    }
}
