<?php

namespace App\DataFixtures;

use App\Factory\SlotFactory;
use App\Factory\SubjectFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

use function Zenstruck\Foundry\faker;

class SlotFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $subjects = SubjectFactory::all();

        foreach ($subjects as $subject) {
            $subjectSemester = $subject->getSemester();
            switch ($subjectSemester->getName()) {
                case 'S1':
                    $listWeek = [36, 37, 38, 39, 40, 41, 42, 43, 45, 46, 47, 48, 49, 50, 51, 2];

                    $nbHours = faker()->numberBetween(1, 4);

                    foreach ($listWeek as $week) {
                        SlotFactory::createOne(['week' => $week, 'nb_hours' => $nbHours, 'subject' => $subject]);
                    }
                    break;
                case 'S2':
                    $listWeek = [3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14, 15, 16, 20, 21, 22, 23];

                    $nbHours = faker()->numberBetween(1, 4);

                    foreach ($listWeek as $week) {
                        SlotFactory::createOne(['week' => $week, 'nb_hours' => $nbHours, 'subject' => $subject]);
                    }
                    break;
                case 'S3':
                    $listWeek = [36, 37, 38, 39, 40, 41, 42, 43, 45, 46, 47, 48, 49, 50, 51, 2, 3];

                    $nbHours = faker()->numberBetween(1, 4);

                    foreach ($listWeek as $week) {
                        SlotFactory::createOne(['week' => $week, 'nb_hours' => $nbHours, 'subject' => $subject]);
                    }
                    break;
                case 'S4':
                    $listWeek = [2, 3, 4, 5, 6, 7, 8, 10, 11, 12, 13, 14];

                    $nbHours = faker()->numberBetween(1, 4);

                    foreach ($listWeek as $week) {
                        SlotFactory::createOne(['week' => $week, 'nb_hours' => $nbHours, 'subject' => $subject]);
                    }
                    break;
                case 'S5':
                    $listWeek = [36, 37, 38, 39, 40, 41, 42, 43, 45, 46, 47, 48, 49, 50, 51];

                    $nbHours = faker()->numberBetween(1, 4);

                    foreach ($listWeek as $week) {
                        SlotFactory::createOne(['week' => $week, 'nb_hours' => $nbHours, 'subject' => $subject]);
                    }
                    break;
                case 'S6':
                    $listWeek = [20, 21, 23, 24];

                    $nbHours = faker()->numberBetween(1, 9);

                    foreach ($listWeek as $week) {
                        SlotFactory::createOne(['week' => $week, 'nb_hours' => $nbHours, 'subject' => $subject]);
                    }
                    break;
            }
        }
    }

    public function getDependencies()
    {
        return [
          SubjectFixtures::class,
            SemesterFixtures::class,
        ];
    }
}
