<?php

namespace App\DataFixtures;

use App\Factory\LessonFactory;
use App\Factory\LessonInformationFactory;
use App\Factory\LessonTypeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LessonInformationFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $lessons = LessonFactory::all();
        $types = LessonTypeFactory::all();
        foreach ($lessons as $lesson) {
            $usedtype = [];
            for ($i = 0; $i == rand(1, 4); ++$i) {
                $type = $types[rand(1, 4)];
                // check if the selected type for the given lesson has already been generated
                while (in_array($type, $usedtype)) {
                    $type = $types[rand(1, 4)];
                }
                // add type generated in the list of used types
                $usedtype[] = $type;
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
                LessonInformationFactory::createOne([
                    'lesson' => $lesson,
                    'lessonType' => $type,
                    'nbGroups' => $nbGroup,
                ]);
            }
        }
    }
}
