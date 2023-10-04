<?php

namespace App\Tests\Api\LessonType;

use App\Entity\LessonType;
use App\Factory\LessonTypeFactory;
use App\Tests\Support\ApiTester;

class LessonTypeGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'lessonInformation' => 'array',
        ];
    }

    public function getLessonType(ApiTester $I): void
    {
        // 1. 'Arrange'

        $data = [
            'name' => 'CM',
        ];
        LessonTypeFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/lesson_types/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(LessonType::class, '/api/lesson_types/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function getLessonTypes(ApiTester $I): void
    {
        // 1. 'Arrange'
        LessonTypeFactory::createMany(3);
        // 2. 'Act'
        $I->sendGet('/api/lesson_types');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(LessonType::class, '/api/lesson_types', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $jsonResponse = $I->grabJsonResponse();
        $I->assertSame(3, $jsonResponse['hydra:totalItems']);
        $I->assertCount(3, $jsonResponse['hydra:member']);
    }
}
