<?php

namespace App\DataFixtures;

use App\Factory\ChoiceFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChoiceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        ChoiceFactory::createMany(50);
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            ExcelDataFixtures::class,
        ];
    }
}
