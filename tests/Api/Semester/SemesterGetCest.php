<?php

declare(strict_types=1);

namespace App\Tests\Api\Semester;

use App\Entity\Semester;
use App\Factory\SemesterFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class SemesterGetCest
{
    public function ConnectedUserGetSemester(ApiTester $I)
    {
        $I->amLoggedInAs(UserFactory::createOne()->object());

        SemesterFactory::createOne([
            'name' => 'S1',
            'year' => 'S2',
        ]);

        $I->sendGet('/api/semesters/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Semester::class, '/api/semesters/1');
        $I->seeResponseIsJson([
            [
                'name' => 'S1',
                'year' => 'S2',
                'subjects' => [],
                'weekStatus' => [],
            ],
        ]);
    }
}
