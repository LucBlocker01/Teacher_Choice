<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserGetMeCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'login' => 'string',
            'lastname' => 'string',
            'roles' => 'array',
            'firstname' => 'string',
            'mail' => 'string',
            'phone' => 'string',
            'postcode' => 'string',
            'city' => 'string',
            'address' => 'string',
            'status' => 'string',
        ];
    }

    public function authenticatedUserOnMeGetData(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $user = UserFactory::createOne()->object();
        UserFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendGet('/api/me');

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/me');
        $I->seeResponseIsAnItem(self::expectedProperties(), ['login' => $user->getLogin()]);
    }

    public function anonymousMeIsUnauthorized(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        UserFactory::createOne();

        // 2. 'Act'
        $I->sendGet('/api/me');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }
}
