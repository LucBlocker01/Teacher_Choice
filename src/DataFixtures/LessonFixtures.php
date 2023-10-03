<?php

namespace App\DataFixtures;

use App\Factory\LessonFactory;
use App\Factory\SubjectFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LessonFixtures extends Fixture implements DependentFixtureInterface
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $subjects = SubjectFactory::all();
        $subjectsName = json_decode(file_get_contents(__DIR__.'/data/Subject.json'), true);

        foreach ($subjects as $subject) {
            $tabSubjects = [$subject];

            $subject2 = SubjectFactory::randomRange(1, 1);

            if ($subject2 != $subject) {
                $tabSubjects[] = $subject2;
            }

            $nameLesson = array_rand($subjectsName, 1);
            $multipleSubjectOrNot = random_int(0, 1);
            if (1 == $multipleSubjectOrNot) {
                LessonFactory::createOne([
                    'name' => $nameLesson,
                ])->addSubject($subject->object());
            } else {
                $lesson = LessonFactory::createOne([
                    'name' => $nameLesson,
                ]);

                $lesson->addSubject($subject->object());
                // $lesson->addSubject($subject2->object());
            }
        }
    }

    public function getDependencies(): array
    {
        return [
            SubjectFixtures::class,
        ];
    }
}
