<?php

namespace App\DataFixtures;

use App\Factory\SubjectFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $json = json_decode(file_get_contents(__DIR__.'/data/Subject.json'), true);

        foreach ($json as $element) {
            SubjectFactory::createOne($element);
        }
    }

    public function getDependencies(): array
    {
        return [
            SemesterFixtures::class,
            SubjectTypeFixtures::class,
        ];
    }
}
