<?php

declare(strict_types=1);

namespace App\Tests\Api\Semester;

use App\Entity\Semester;
use App\Factory\SemesterFactory;
use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class SemesterGetCest
{
    public function ConnectedUserCanGetSemester(ApiTester $I): void
    {
        $I->amLoggedInAs(UserFactory::createOne([
            'status' => StatusFactory::createOne(),
        ])->object());

        SemesterFactory::createOne([
            'name' => 'S1',
            'year' => 2023,
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

    public function AnonymousUserCanGetSemester(ApiTester $I): void
    {
        SemesterFactory::createOne([
            'name' => 'S1',
            'year' => 2023,
        ]);

        $I->sendGet('/api/semesters/1');
        $I->seeResponseCodeIsSuccessful();
    }

    public function ConnectedUserCanGetSemesterCollection(ApiTester $I): void
    {
        $I->amLoggedInAs(UserFactory::createOne([
            'status' => StatusFactory::createOne(),
        ])->object());

        SemesterFactory::createOne([
            'name' => 'S1',
            'year' => 2023,
        ]);

        $I->sendGet('/api/semesters');

        $I->seeResponseCodeIs(HttpCode::OK);
    }

    public function AnonymousUserCanGetSemesterCollection(ApiTester $I): void
    {
        SemesterFactory::createOne([
            'name' => 'S1',
            'year' => 2023,
        ]);

        $I->sendGet('/api/semesters');

        $I->seeResponseCodeIsSuccessful();
    }
}
