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
use App\Factory\WeekStatusFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class ChoicePatchCest
{
    public function patchChoiceAnonymousUser(ApiTester $i): void
    {
        // Generate data
        // Generate User
        StatusFactory::createMany(4);
        UserFactory::createOne();

        // Generate lesson
        SemesterFactory::createOne();
        WeekFactory::createMany(5);
        WeekStatusFactory::createMany(5);
        SubjectFactory::createOne();
        LessonFactory::createOne([
            'name' => 'Maths',
        ]);
        LessonTypeFactory::createMany(5);
        LessonInformationFactory::createMany(5);
        LessonPlanningFactory::createMany(5);
        ChoiceFactory::createOne();

        $i->sendPatch('/api/choices/1', [
            'nbGroupSelected' => 3,
        ]);
        $i->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function patchOwnChoice(ApiTester $i): void
    {
        // Generate data
        // Generate User
        StatusFactory::createMany(4);
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        $i->amLoggedInAs($user);

        // Generate lesson
        SemesterFactory::createOne();
        WeekFactory::createMany(5);
        WeekStatusFactory::createMany(5);
        SubjectFactory::createOne();
        LessonFactory::createOne([
            'name' => 'Maths',
        ]);
        LessonTypeFactory::createMany(5);
        LessonInformationFactory::createMany(5);
        LessonPlanningFactory::createMany(5);
        ChoiceFactory::createOne();

        $i->sendPatch('/api/choices/1', [
            'nbGroupSelected' => 3,
        ]);
        $i->seeResponseCodeIs(HttpCode::OK);
    }
}
