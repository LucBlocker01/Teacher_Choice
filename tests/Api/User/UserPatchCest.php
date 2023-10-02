<?php

namespace App\Tests\Api\User;

class UserPatchCest
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
