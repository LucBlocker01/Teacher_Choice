<?php

namespace App\DataFixtures;

use App\Factory\LessonPlanningFactory;
use App\Factory\WeekFactory;
use App\Factory\WeekStatusFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LessonPlanningFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        /*$weeks = WeekFactory::all();
        foreach ($weeks as $week) {
            if (!$week->getWeekStatus()->isHoliday() && !$week->getWeekStatus()->isWorkStudy() && !$week->getWeekStatus()->isInternship()) {
                LessonPlanningFactory::createMany(rand(1, 5), [
                    'week' => $week,
                ]);
            }
        }*/

        $weeksStatus = WeekStatusFactory::all();

        foreach ($weeksStatus as $weekStatus) {
            if (!$weekStatus->isHoliday() && !$weekStatus->isWorkStudy() && !$weekStatus->isInternship()) {
                LessonPlanningFactory::createMany(rand(1, 5), [
                    'weekStatus' => $weekStatus,
                ]);
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            WeekStatusFixtures::class,
            LessonInformationFixtures::class,
        ];
    }
}
