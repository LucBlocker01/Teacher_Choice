<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\StatusFactory;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
use Codeception\Attribute\DataProvider;
use Codeception\Example;
use Codeception\Util\HttpCode;

class UserPatchCest
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

    public function anonymousUserForbiddenToPatchUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        UserFactory::createOne();

        // 2. 'Act'
        $I->sendPatch('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPatchOtherUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $user = UserFactory::createOne()->object();
        UserFactory::createOne();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $I->sendPatch('/api/users/2');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::FORBIDDEN);
    }

    public function authenticatedUserCanPatchOwnData(ApiTester $I): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $dataInit = [
            'login' => 'user1',
        ];

        $user = UserFactory::createOne($dataInit)->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPatch = [
            'login' => 'user2',
        ];
        $I->sendPatch('/api/users/1', $dataPatch);

        // 3. 'Assert'
        $I->seeResponseCodeIsSuccessful();
        $I->seeResponseIsJson();
        $I->seeResponseIsAnEntity(User::class, '/api/users/1');
        $I->seeResponseIsAnItem(self::expectedProperties(), $dataPatch);
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
        $dataPatch = ['password' => 'new password'];
        $I->sendPatch('/api/users/1', $dataPatch);

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

    protected function invalidDataLeadsToUnprocessableEntityProvider(): array
    {
        return [
            ['property' => 'login', 'value' => '<&">'],
        ];
    }

    #[DataProvider('invalidDataLeadsToUnprocessableEntityProvider')]
    public function invalidDataLeadsToUnprocessableEntity(ApiTester $I, Example $example): void
    {
        // 1. 'Arrange'
        StatusFactory::createMany(5);
        $user = UserFactory::createOne()->object();
        $I->amLoggedInAs($user);

        // 2. 'Act'
        $dataPut = [
            $example['property'] => $example['value'],
        ];
        $I->sendPut('/api/users/1', $dataPut);

        // 3. 'Assert'
        $I->seeResponseCodeIs(422);
        $I->seeResponseIsJson();
    }
}
