<?php

namespace App\DataFixtures;

use App\Factory\WeekFactory;
use App\Factory\WeekStatusFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class WeekStatusFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $weeks = WeekFactory::all();
        foreach ($weeks as $week) {
            WeekStatusFactory::createOne([
                'week' => $week,
            ]);
        }
    }

    public function getDependencies()
    {
        return [
            SemesterFixtures::class,
            WeekFixtures::class,
        ];
    }
}
