<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;

class UserGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'login' => 'string',
            'roles' => 'array',
            'lastname' => 'string',
            'firstname' => 'string',
            'status' => 'array',
        ];
    }

    public function anonymousUserGetSimpleUserElement(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $data = [
            'login' => 'user1',
        ];
        UserFactory::createOne($data);

        // 2. 'Act'
        $I->sendGet('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }

    public function authenticatedUserGetSimpleUserElementForOthers(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $data = [
            'login' => 'user1',
        ];
        $user = UserFactory::createOne()->object();
        UserFactory::createOne($data);
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendGet('/api/users/2');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/2');
        $I->seeResponseIsAnItem(self::expectedProperties(), $data);
    }
}
