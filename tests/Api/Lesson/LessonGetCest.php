<?php

declare(strict_types=1);

namespace App\Tests\Api\Lesson;

use App\Entity\Lesson;
use App\Factory\LessonFactory;
use App\Tests\Support\ApiTester;

class LessonGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'subjects' => 'array',
            'lessonInformation' => 'array',
        ];
    }

    public function anonymousUserGetLessonElement(ApiTester $I): void
    {
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
}
