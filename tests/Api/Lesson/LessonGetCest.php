<?php

declare(strict_types=1);

namespace App\Tests\Api\Lesson;

use App\Entity\Lesson;
use App\Factory\LessonFactory;
use App\Factory\StatusFactory;
use App\Factory\SubjectFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class LessonGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'subject' => 'string',
            'lessonInformation' => 'array',
            'tags' => 'array',
        ];
    }

    public function anonymousUserGetLessonElement(ApiTester $I): void
    {
        SubjectFactory::createMany(3);
        $data = [
            'name' => 'test_lesson',
        ];
        LessonFactory::createOne($data);

        $I->sendGet('api/lessons/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Lesson::class, '/api/lessons/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function authenticatedUserGetLessonElement(ApiTester $I): void
    {
        StatusFactory::createMany(5);
        SubjectFactory::createMany(3);
        $data = [
            'name' => 'test_lesson',
        ];
        LessonFactory::createOne($data);

        $user = UserFactory::createOne()->object();
        $I->amLoggedInAs($user);
        $I->sendGet('api/lessons/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Lesson::class, '/api/lessons/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
