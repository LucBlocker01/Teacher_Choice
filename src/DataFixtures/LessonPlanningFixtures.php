<?php

namespace App\DataFixtures;

use App\Factory\LessonPlanningFactory;
use App\Factory\WeekFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LessonPlanningFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $weeks = WeekFactory::all();
        foreach ($weeks as $week) {
            if (!$week->getWeekStatus()->isHoliday() && !$week->getWeekStatus()->isWorkStudy() && !$week->getWeekStatus()->isInternship()) {
                LessonPlanningFactory::createMany(rand(1, 5), [
                    'week' => $week,
                ]);
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            WeekFixtures::class,
        ];
    }
}
