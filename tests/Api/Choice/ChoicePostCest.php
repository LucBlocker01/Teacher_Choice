<?php

namespace App\Tests\Api\Choice;

use App\Entity\Choice;
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

class ChoicePostCest
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
    }

    public static function postChoiceAnonymousUser(ApiTester $i): void
    {
        $i->sendPost('/api/choices', [
            'nbGroupSelected' => 4,
            'year' => '2023',
            'teacher' => '/api/users/1',
            'nbGroupAttributed' => 0,
            'lessonInformation' => '/api/lesson_informations/1',
        ]);
        $i->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public static function postChoiceAdminOk(ApiTester $i): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN']]);
        $i->amLoggedInAs($user->object());

        $i->sendPost('/api/choices', [
            'nbGroupSelected' => 4,
            'year' => '2023',
            'teacher' => '/api/users/2',
            'nbGroupAttributed' => 0,
            'lessonInformation' => '/api/lesson_informations/1',
        ]);
        $i->seeResponseCodeIs(HttpCode::CREATED);
    }

    public static function postChoiceUserOk(ApiTester $i): void
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        $i->amLoggedInAs($user);

        $i->sendPost('/api/choices', [
            'nbGroupSelected' => 4,
            'year' => '2023',
            'teacher' => '/api/users/2',
            'nbGroupAttributed' => 0,
            'lessonInformation' => '/api/lesson_informations/1',
        ]);
        $i->seeResponseCodeIs(HttpCode::CREATED);
        $i->seeResponseIsJson();
        $i->seeResponseIsAnEntity(Choice::class, '/api/choices/1');
    }
}
