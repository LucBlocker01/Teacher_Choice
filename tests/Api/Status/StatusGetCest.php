<?php

declare(strict_types=1);

namespace App\Tests\Api\Status;

use App\Entity\Status;
use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class StatusGetCest
{
    protected function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'name' => 'string',
            'minHours' => 'float',
            'maxHours' => 'float',
            'users' => 'array',
        ];
    }

    public function anonymousUserGetStatus(ApiTester $I): void
    {
        $data = [
            'name' => 'totallyanadmin',
            'minHours' => 4.4,
            'maxHours' => 5.78,
        ];
        StatusFactory::createOne($data);

        $I->sendGet('api/statuses/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Status::class, '/api/statuses/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function authenticatedUserGetStatus(ApiTester $I): void
    {
        $data = [
            'name' => 'test',
            'minHours' => 4.4,
            'maxHours' => 5.78,
        ];
        StatusFactory::createOne($data);
        $user = UserFactory::createOne()->object();
        $I->amLoggedInAs($user);

        $I->sendGet('api/statuses/1');

        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(Status::class, '/api/statuses/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
