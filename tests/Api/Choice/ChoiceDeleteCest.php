<?php

namespace App\Tests\Api\Choice;

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
use Codeception\Util\HttpCode;

class ChoiceDeleteCest
{
    public function _before(ApiTester $I)
    {
        // Generate data
        // Generate User
        StatusFactory::createMany(4);
        UserFactory::createOne();

        // Generate lesson
        SemesterFactory::createOne();
        WeekFactory::createMany(5);
        SubjectFactory::createOne();
        LessonFactory::createOne([
            'name' => 'Maths',
        ]);
        LessonTypeFactory::createMany(5);
        LessonInformationFactory::createMany(5);
        LessonPlanningFactory::createMany(5);
        ChoiceFactory::createOne();
    }

    public static function deleteChoiceAnonymousUser(ApiTester $i): void
    {
        $i->sendDelete('/api/choices/1');
        $i->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public static function deleteOurChoice(ApiTester $i): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_TEACHER']]);
        ChoiceFactory::createOne(['teacher' => $user]);
        $i->amLoggedInAs($user->object());

        $i->sendDelete('/api/choices/2');
        $i->seeResponseCodeIs(HttpCode::NO_CONTENT);
    }

    public static function deleteOtherChoice(ApiTester $i): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        $i->amLoggedInAs($user);

        $i->sendDelete('/api/choices/1');
        $i->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
