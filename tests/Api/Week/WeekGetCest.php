<?php

namespace App\Tests\Api\Week;

use App\Entity\Week;
use App\Factory\SemesterFactory;
use App\Factory\WeekFactory;
use App\Factory\WeekStatusFactory;
use App\Tests\Support\ApiTester;

class WeekGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'weekNum' => 'integer',
            'weeksStatus' => 'array',
        ];
    }

    public function getWeek(ApiTester $I): void
    {
        // 1. 'Arrange'
        SemesterFactory::createMany(3);
        $data = [
            'weekNum' => 1,
        ];
        WeekFactory::createOne($data);
        WeekStatusFactory::createMany(5);
        // 2. 'Act'
        $I->sendGet('/api/weeks/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Week::class, '/api/weeks/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function getWeeks(ApiTester $I): void
    {
        // 1. 'Arrange'
        SemesterFactory::createMany(3);
        WeekFactory::createMany(3);
        WeekStatusFactory::createMany(3);
        // 2. 'Act'
        $I->sendGet('/api/weeks');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Week::class, '/api/weeks', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $jsonResponse = $I->grabJsonResponse();
        $I->assertSame(3, $jsonResponse['hydra:totalItems']);
        $I->assertCount(3, $jsonResponse['hydra:member']);
    }
}
