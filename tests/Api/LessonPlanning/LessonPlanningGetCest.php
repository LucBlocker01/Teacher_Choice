<?php

declare(strict_types=1);

namespace App\Tests\Api\LessonPlanning;

class LessonPlanningGetCest
{
    protected function expectedProperties(): array
    {
        return [
            'id' => 'integer',
            'nbHours' => 'integer',
            'information' => 'string:path',
            'weekStatus' => 'string:path',
        ];
    }
}
