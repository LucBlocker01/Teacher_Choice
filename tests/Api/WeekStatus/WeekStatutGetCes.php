<?php

namespace App\Tests\Api\WeekStatus;

use App\Entity\WeekStatus;
use App\Factory\SemesterFactory;
use App\Factory\WeekFactory;
use App\Factory\WeekStatusFactory;
use App\Tests\Support\ApiTester;

class WeekStatutGetCes
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'holiday' => 'bool',
            'work_study' => 'bool',
            'workStudy' => 'bool',
        ];
    }

    public function getWeekStatus(ApiTester $I): void
    {
        // 1. 'Arrange'
        SemesterFactory::createMany(3);
        WeekFactory::createMany(3);
        $data = [
            'holiday' => false,
            'work_study' => false,
            'workStudy' => false,
        ];
        WeekStatusFactory::createOne($data);
        // 2. 'Act'
        $I->sendGet('/api/week_statuses/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(WeekStatus::class, '/api/week_statuses/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function getWeekStatuses(ApiTester $I): void
    {
        // 1. 'Arrange'
        SemesterFactory::createMany(3);
        WeekFactory::createMany(3);
        WeekStatusFactory::createMany(3);
        // 2. 'Act'
        $I->sendGet('/api/week_statuses');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(WeekStatus::class, '/api/week_statuses', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $jsonResponse = $I->grabJsonResponse();
        $I->assertSame(3, $jsonResponse['hydra:totalItems']);
        $I->assertCount(3, $jsonResponse['hydra:member']);
    }
}
