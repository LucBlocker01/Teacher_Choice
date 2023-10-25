<?php

namespace App\DataFixtures;

use App\Utils\ExcelManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ExcelDataFixtures extends Fixture implements DependentFixtureInterface
{
    private ExcelManager $excelManager;

    public function __construct(ExcelManager $excelManager)
    {
        $this->excelManager = $excelManager;
    }

    public function load(ObjectManager $manager): void
    {
        $this->excelManager->importExcel();
    }

    public function getDependencies()
    {
        return [
          StatusFixtures::class,
          UserFixtures::class,
          WeekFixtures::class,
          LessonTypeFixtures::class,
        ];
    }
}
