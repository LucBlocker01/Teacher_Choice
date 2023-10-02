<?php

namespace App\Tests\Api\User;

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
            'phones' => 'string',
            'postcode' => 'string',
            'city' => 'string',
            'adress' => 'string',
        ];
    }
}
