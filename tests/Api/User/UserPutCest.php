<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Util\HttpCode;

class UserPutCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'login' => 'string',
            'roles' => 'array',
            'firstname' => 'string',
            'lastname' => 'string',
            'status' => 'array',
        ];
    }

    public function anonymousUserForbiddenToPutUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        UserFactory::createOne();
        // 2. 'Act'
        $I->sendPut('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPutOtherUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $user = UserFactory::createOne()->object();
        UserFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendPut('/api/users/2');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function authenticatedUserCanPutOwnData(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $dataInit = [
            'login' => 'user1',
            'password' => 'password',
        ];

        $user = UserFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = [
            'login' => 'user2',
        ];

        $I->sendPut('/api/users/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPut);
    }

    public function authenticatedUserCanChangeHisPassword(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $dataInit = [
            'login' => 'user',
            'password' => 'password',
        ];

        $user = UserFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = ['password' => 'new password'];
        $I->sendPut('/api/users/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties());

        // 2. 'Act'
        $I->amOnPage('/logout');
        // Don't check response code since homepage is not configured (404)
        // $I->seeResponseCodeIsSuccessful();
        $I->amOnRoute('app_login');
        $I->seeResponseCodeIsSuccessful();
        $I->submitForm(
            'form',
            ['login' => 'user1', 'password' => 'new password'],
            'Authentification'
        );
        $I->seeResponseCodeIsSuccessful();
    }
}
