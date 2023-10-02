<?php

namespace App\DataFixtures;

use App\Factory\SemesterFactory;
use App\Factory\SubjectFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SubjectFixtures extends Fixture
{
    /**
     * @throws \Exception
     */
    public function load(ObjectManager $manager): void
    {
        $specialities = ['', 'R', 'A'];
        $semesters = SemesterFactory::all();

        foreach ($semesters as $semester) {
            $semesterNumber = substr($semester->getName(), -1);
            if ($semesterNumber <= 3) {
                for ($ele = 1; $ele <= 14; ++$ele) {
                    SubjectFactory::createOne([
                        'name' => 'MR'.$semesterNumber.sprintf("%'.02d", $ele),
                        'semester' => SemesterFactory::new(),
                        'speciality' => null,
                    ]);
                }
            } else {
                for ($ele = 1; $ele <= 14; ++$ele) {
                    $rand = random_int(0, 2);
                    $speciality = $specialities[$rand];
                    if ('' == $speciality) {
                        $speciality = null;
                    }
                    SubjectFactory::createOne([
                        'name' => 'MR'.$semesterNumber.sprintf("%'.02d", $ele).$specialities[$rand],
                        'semester' => SemesterFactory::new(),
                        'speciality' => $speciality,
                    ]);
                }
            }
        }
    }
}
