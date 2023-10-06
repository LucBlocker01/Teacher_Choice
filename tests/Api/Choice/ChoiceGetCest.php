<?php

namespace App\Tests\Api\Choice;

use App\Entity\Choice;
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

class ChoiceGetCest
{
    protected static function setup(): void
    {
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
    }

    public function getChoiceWithAnonymousUser(ApiTester $i): void
    {
        // Generate User
        StatusFactory::createMany(4);
        UserFactory::createOne();
        $this->setup();

        $i->sendGet('/api/choices/1');
        $i->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function getChoiceWithAdminUser(ApiTester $i): void
    {
        // Generate User
        StatusFactory::createMany(4);
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        $i->amLoggedInAs($user);

        $this->setup();

        $i->sendGet('/api/choices/1');

        $i->seeResponseCodeIsSuccessful();
        $i->seeResponseIsJson();
        $i->seeResponseIsAnEntity(Choice::class, '/api/choices/1');
    }

    public function getOwnChoice(ApiTester $i): void
    {
        // Generate User
        StatusFactory::createMany(4);
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        $i->amLoggedInAs($user);

        $this->setup();

        $i->sendGet('/api/choices/1');

        $i->seeResponseCodeIsSuccessful();
        $i->seeResponseIsJson();
        $i->seeResponseIsAnEntity(Choice::class, '/api/choices/1');
    }

    public function getOtherChoice(ApiTester $i): void
    {
        // Generate User
        StatusFactory::createMany(4);
        UserFactory::createOne(['roles' => ['ROLE_USER']]);

        $this->setup();

        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        $i->amLoggedInAs($user);

        $i->sendGet('/api/choices/1');

        $i->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }
}
