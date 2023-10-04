<?php

declare(strict_types=1);

namespace App\Tests\Api\Subject;

use App\Entity\Subject;
use App\Factory\SemesterFactory;
use App\Factory\StatusFactory;
use App\Factory\SubjectFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class SubjectGetCest
{
    public function ConnectedUserCanGetSubject(ApiTester $I): void
    {
        $I->amLoggedInAs(UserFactory::createOne([
            'status' => StatusFactory::createOne(),
        ])->object());

        SubjectFactory::createOne([
            'name' => 'MR???',
            'semester' => SemesterFactory::createOne(),
            'speciality' => '',
        ]);

        $I->sendGet('/api/subjects/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Subject::class, '/api/subjects/1');
        $I->seeResponseIsJson([
            [
                'name' => 'MR???',
                'semester' => SemesterFactory::createOne(),
                'speciality' => '',
            ],
        ]);
    }

    public function AnonymousUserCannotGetSubject(ApiTester $I): void
    {
        SubjectFactory::createOne([
            'name' => 'MR???',
            'semester' => SemesterFactory::createOne(),
            'speciality' => '',
        ]);

        $I->sendGet('/api/subjects/1');

        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }
}
