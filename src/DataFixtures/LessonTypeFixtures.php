<?php

namespace App\DataFixtures;

use App\Factory\LessonTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LessonTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        LessonTypeFactory::createOne(['name' => 'CM']);
        LessonTypeFactory::createOne(['name' => 'TD']);
        LessonTypeFactory::createOne(['name' => 'TDM']);
        LessonTypeFactory::createOne(['name' => 'TP']);
    }
}
