<?php

namespace App\Tests\Controller;

use App\Entity\Subject;
use App\Factory\LessonFactory;
use App\Factory\LessonInformationFactory;
use App\Factory\LessonTypeFactory;
use App\Factory\SemesterFactory;
use App\Factory\StatusFactory;
use App\Factory\SubjectFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class GetSubjectBySemesterCest
{
    protected function prepare(): void
    {
        LessonTypeFactory::createOne();
        SemesterFactory::createMany(2);
        SubjectFactory::createMany(5);
        LessonFactory::createOne();
        LessonInformationFactory::createMany(5);
        StatusFactory::createMany(3);
    }

    public function anonymousUserCanGetSubjectsBySemester(ApiTester $I)
    {
        $I->sendGet('/api/subjects/semester/1');
        $I->seeResponseCodeIsSuccessful();
    }

    public function connectedUserCanGetSubjectsBySemester(ApiTester $I)
    {
        $user = UserFactory::createOne(['roles' => ['ROLE_USER']])->object();
        $I->amLoggedInAs($user);
        $I->sendGet('/api/subjects/semester/1');
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsACollection(Subject::class, '/api/subjects/semester/1');
    }
}
