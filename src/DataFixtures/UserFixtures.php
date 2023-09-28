<?php

namespace App\DataFixtures;

use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne([
            'login' => 'admin',
            'password' => 'test',
            'roles' => ['ROLE_ADMIN'],
        ]);
        UserFactory::createOne([
            'login' => 'teacher',
            'password' => 'test',
            'roles' => ['ROLE_USER'],
        ]);
        UserFactory::createMany(3);
    }

    public function getDependencies()
    {
        return [
          StatusFixtures::class,
        ];
    }
}
