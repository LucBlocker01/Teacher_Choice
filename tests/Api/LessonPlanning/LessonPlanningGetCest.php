<?php

declare(strict_types=1);

namespace App\Tests\Api\LessonPlanning;

use App\Entity\LessonPlanning;
use App\Factory\LessonFactory;
use App\Factory\LessonInformationFactory;
use App\Factory\LessonPlanningFactory;
use App\Factory\LessonTypeFactory;
use App\Factory\SemesterFactory;
use App\Factory\StatusFactory;
use App\Factory\SubjectFactory;
use App\Factory\UserFactory;
use App\Factory\WeekFactory;
use App\Factory\WeekStatusFactory;
use App\Tests\Support\ApiTester;

class LessonPlanningGetCest
{
    protected function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'nbHours' => 'integer',
            'information' => 'string:path',
            'weekStatus' => 'string:path',
        ];
    }

    public function anonymousUserGetLessonPlanning(ApiTester $I): void
    {
        SemesterFactory::createOne();
        SubjectFactory::createMany(3);
        WeekFactory::createOne();
        WeekStatusFactory::createMany(3);
        LessonTypeFactory::createMany(3);
        LessonFactory::createOne([
            'name' => 'test_lesson',
        ]);
        LessonInformationFactory::createMany(5);
        $data = [
            'nbHours' => 999,
        ];
        LessonPlanningFactory::createOne($data);

        $I->sendGet('api/lesson_plannings/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(LessonPlanning::class, '/api/lesson_plannings/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function authenticatedUserGetLessonPlanning(ApiTester $I): void
    {
        StatusFactory::createOne();
        SemesterFactory::createOne();
        SubjectFactory::createMany(3);
        WeekFactory::createOne();
        WeekStatusFactory::createMany(3);
        LessonTypeFactory::createMany(3);
        LessonFactory::createOne([
            'name' => 'test_lesson',
        ]);
        $user = UserFactory::createOne()->object();
        LessonInformationFactory::createMany(5);
        $data = [
            'nbHours' => 999,
        ];
        LessonPlanningFactory::createOne($data);
        $I->amLoggedInAs($user);

        $I->sendGet('api/lesson_plannings/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(LessonPlanning::class, '/api/lesson_plannings/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}