<?php

namespace App\DataFixtures;

use App\Factory\SubjectFactory;
use App\Factory\SubjectTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        SubjectFactory::createMany(40, function () {
            $randomNumber = rand(1, 4);
            if (1 == $randomNumber) {
                return [
                    'nb_group' => 1,
                    'type' => SubjectTypeFactory::find(['id' => 1]),
                ];
            }
            if (2 == $randomNumber) {
                return [
                    'nb_group' => 2,
                    'type' => SubjectTypeFactory::find(['id' => 2]),
                ];
            }
            if (3 == $randomNumber) {
                return [
                    'nb_group' => 2,
                    'type' => SubjectTypeFactory::find(['id' => 3]),
                ];
            } else {
                return [
                    'nb_group' => 4,
                    'type' => SubjectTypeFactory::find(['id' => 4]),
                ];
            }
        });
    }

    public function getDependencies(): array
    {
        return [
            SemesterFixtures::class,
            SubjectTypeFixtures::class,
        ];
    }
}
