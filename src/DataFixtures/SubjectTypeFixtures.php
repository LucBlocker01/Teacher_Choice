<?php

namespace App\DataFixtures;

use App\Factory\SubjectTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectTypeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SubjectTypeFactory::createOne(['name' => 'CM']);
        SubjectTypeFactory::createOne(['name' => 'TD']);
        SubjectTypeFactory::createOne(['name' => 'TDM']);
        SubjectTypeFactory::createOne(['name' => 'TP']);
    }
}
