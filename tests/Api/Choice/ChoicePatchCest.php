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

class ChoicePatchCest
{
    public function _before(ApiTester $i): void
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

    public function patchChoiceAnonymousUser(ApiTester $i): void
    {
        $i->sendPatch('/api/choices/1', [
            'nbGroupSelected' => 3,
        ]);
        $i->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function patchOwnChoice(ApiTester $i): void
    {
        // Generate data
        // Generate User
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']]);
        ChoiceFactory::createOne(['teacher' => $user]);
        $i->amLoggedInAs($user->object());

        $i->sendPatch('/api/choices/2', [
            'nbGroupSelected' => 3,
        ]);
        $i->seeResponseCodeIs(HttpCode::OK);
    }

    public function PatchOtherUserChoice(ApiTester $i): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        ChoiceFactory::createOne(['teacher' => $user]);
        $i->amLoggedInAs($user);

        $i->sendPatch('/api/choices/1', [
            'nbGroupSelected' => 3,
        ]);
        $i->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
