<?php

declare(strict_types=1);

namespace App\Tests\Api\LessonInformation;

use App\Entity\LessonInformation;
use App\Factory\ChoiceFactory;
use App\Factory\LessonFactory;
use App\Factory\LessonInformationFactory;
use App\Factory\LessonPlanningFactory;
use App\Factory\LessonTypeFactory;
use App\Factory\SemesterFactory;
use App\Factory\StatusFactory;
use App\Factory\SubjectFactory;
use App\Factory\UserFactory;
use App\Factory\WeekFactory;
use App\Tests\Support\ApiTester;

class LessonInformationGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'nbGroups' => 'integer',
            'saeSupport' => 'string',
            'lesson' => 'string',
            'lessonType' => 'string',
            'lessonPlannings' => 'array',
            'choices' => 'array',
        ];
    }

    public function _before(): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(3);
        UserFactory::createOne();
        SemesterFactory::createMany(3);
        SubjectFactory::createMany(3);
        WeekFactory::createMany(3);
        LessonFactory::createMany(3);
        LessonTypeFactory::createMany(3);
        LessonInformationFactory::createMany(3);
        LessonPlanningFactory::createMany(3);
        ChoiceFactory::createMany(3);
    }

    public function getLessonInformation(ApiTester $I): void
    {
        $data = [
            'nbGroups' => 4,
            'saeSupport' => '',
        ];
        LessonInformationFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/lesson_informations/4');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(LessonInformation::class, '/api/lesson_informations/4');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function getLessonInformations(ApiTester $I): void
    {
        // 2. 'Act'
        $I->sendGet('/api/lesson_informations');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(LessonInformation::class, '/api/lesson_informations', [
            'hydra:member' => 'array',
            'hydra:totalItems' => 'integer',
        ]);
        $jsonResponse = $I->grabJsonResponse();
        $I->assertSame(3, $jsonResponse['hydra:totalItems']);
        $I->assertCount(3, $jsonResponse['hydra:member']);
    }
}
