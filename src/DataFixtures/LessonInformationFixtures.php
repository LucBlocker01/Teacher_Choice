<?php

namespace App\DataFixtures;

use App\Factory\LessonFactory;
use App\Factory\LessonInformationFactory;
use App\Factory\LessonTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LessonInformationFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $lessons = LessonFactory::all();

        foreach ($lessons as $lesson) {
            $types = LessonTypeFactory::randomRange(1, 3);

            foreach ($types as $type) {
                switch ($type) {
                    case 'CM' == $type->getName():
                        $nbGroup = 1;
                        break;
                    case 'TD' == $type->getName() || 'TDM' == $type->getName():
                        $nbGroup = rand(1, 4);
                        break;
                    case 'TP' == $type->getName():
                        $nbGroup = rand(2, 8);
                }

                // add type generated in the list of used types

                // $SAE = LessonInformationFactory::faker()->boolean(10);
                $SAE = '';
                LessonInformationFactory::createOne([
                    'lesson' => $lesson,
                    'lessonType' => $type,
                    'nbGroups' => $nbGroup,
                    'SAESupport' => $SAE,
                ]);
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            LessonFixtures::class,
            LessonTypeFixtures::class,
        ];
    }
}
