<?php

namespace App\DataFixtures;

use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $statuses = StatusFactory::all();
        UserFactory::createOne([
            'login' => 'admin',
            'password' => 'test',
            'roles' => ['ROLE_ADMIN'],
            'status' => $statuses[0],
        ]);
        UserFactory::createOne([
            'login' => 'teacher',
            'password' => 'test',
            'roles' => ['ROLE_USER'],
            'status' => $statuses[2],
        ]);
        UserFactory::createMany(25, function () {
            $statuses = StatusFactory::all();

            return [
                'status' => $statuses[rand(1, 3)],
                ];
        });
    }

    public function getDependencies()
    {
        return [
          StatusFixtures::class,
        ];
    }
}
