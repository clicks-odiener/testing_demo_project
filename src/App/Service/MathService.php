<?php

declare(strict_types=1);

namespace App\Service;

class MathService
{
    public function sum(int $a, int $b): int
    {
        return $a + $b;
    }

    public function product(int $a, int $b): float
    {
        return $a * $b;
    }
}
