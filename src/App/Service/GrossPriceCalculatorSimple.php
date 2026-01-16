<?php

declare(strict_types=1);

namespace App\Service;

class GrossPriceCalculatorSimple
{
    public const TAX_RATE = 0.19;

    public function calculateFromNetPrice(float $netPrice): float
    {
        $grossPrice = $netPrice + ($netPrice * self::TAX_RATE);

        return round($grossPrice, 2);
    }
}
