<?php

namespace App\DataFixtures;

use App\Factory\SubjectFactory;
use App\Factory\SubjectTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        SubjectFactory::createMany(40, function () {
            $randomNumber = rand(1, 4);
            if (1 == $randomNumber) {
                return [
                    'nb_group' => 1,
                    'type' => SubjectTypeFactory::createOne(['name' => 'CM']),
                ];
            }
            if (2 == $randomNumber) {
                return [
                    'nb_group' => 2,
                    'type' => SubjectTypeFactory::createOne(['name' => 'TD']),
                ];
            }
            if (3 == $randomNumber) {
                return [
                    'nb_group' => 2,
                    'type' => SubjectTypeFactory::createOne(['name' => 'TDM']),
                ];
            } else {
                return [
                    'nb_group' => 4,
                    'type' => SubjectTypeFactory::createOne(['name' => 'TP']),
                ];
            }
        });
    }
}
