<?php

namespace App\Tests\Api\User;

class UserGetCest
{
    protected static function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'login' => 'string',
            'roles' => 'array',
        ];
    }
}
