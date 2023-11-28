<?php

namespace App\Tests\Controller;

use App\Entity\Choice;
use App\Factory\ChoiceFactory;
use App\Factory\LessonFactory;
use App\Factory\LessonInformationFactory;
use App\Factory\LessonTypeFactory;
use App\Factory\StatusFactory;
use App\Factory\SubjectFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class GetChoicesByTeacherCest
{
    protected function prepare(): void
    {
        LessonTypeFactory::createOne();
        SubjectFactory::createOne();
        LessonFactory::createOne();
        LessonInformationFactory::createMany(5);
        StatusFactory::createMany(3);
    }

    public function anonymousUserCannotGetChoiceByTeacher(ApiTester $I): void
    {
        $this->prepare();
        UserFactory::createMany(2);
        ChoiceFactory::createMany(5);
        $I->sendGet('/api/user/choice/1');
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function connectedUserCannotGetChoiceByTeacher(ApiTester $I): void
    {
        $this->prepare();
        UserFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        $I->amLoggedInAs($user);
        ChoiceFactory::createMany(5);
        $I->sendGet('/api/user/choice/1');
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function connectedAdminCanGetChoiceByTeacher(ApiTester $I): void
    {
        $this->prepare();
        UserFactory::createOne();
        $user = UserFactory::createOne(['roles' => ['ROLE_ADMIN']])->object();
        $I->amLoggedInAs($user);
        $data = [
            'nbGroupSelected' => 4,
        ];
        ChoiceFactory::createOne($data);
        $I->sendGet('/api/user/choice/1');
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Choice::class, '/api/user/choice/1');
    }
}
