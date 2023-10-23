<?php

namespace App\DataFixtures;

use App\Factory\LessonFactory;
use App\Factory\TagFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        TagFactory::createMany(50, function () {
            $lessons = LessonFactory::all();

            return [
                'lessons' => [
                    $lessons[array_rand($lessons)],
                    $lessons[array_rand($lessons)],
                ],
            ];
        });

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
          LessonFixtures::class,
        ];
    }
}
