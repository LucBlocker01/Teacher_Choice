<?php

namespace App\Tests\Api\User;

use App\Entity\User;
use App\Factory\UserFactory;
use App\Tests\Support\ApiTester;
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
        ];
    }

    public function anonymousUserForbiddenToPatchUser(ApiTester $I): void
    {
        // 1. 'Arrange'
        UserFactory::createOne();

        // 2. 'Act'
        $I->sendPatch('/api/users/1');

        // 3. 'Assert'
        $I->seeResponseCodeIs(HttpCode::UNAUTHORIZED);
    }

    public function authenticatedUserForbiddenToPatchOtherUser(ApiTester $I): void
    {
        // 1. 'Arrange'
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
}
