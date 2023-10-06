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
            $nameLesson = $subjectsName[array_rand($subjectsName, 1)]['name'];

            LessonFactory::createOne([
                'name' => $nameLesson,
                'subject' => $subject,
            ]);
        }
    }

    public function getDependencies(): array
    {
        return [
            SubjectFixtures::class,
        ];
    }
}
