<?php

declare(strict_types=1);

namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;

class ExcelManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
