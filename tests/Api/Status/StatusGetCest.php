<?php

declare(strict_types=1);

namespace App\Tests\Api\Status;

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
}
