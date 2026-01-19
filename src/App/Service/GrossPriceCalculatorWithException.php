<?php

declare(strict_types=1);

namespace App\Service;

use InvalidArgumentException;

class GrossPriceCalculatorWithException
{
    public function calculateFromNetPrice(float $netPrice, float $taxRate): float
    {
        if ($taxRate < 0) {
            throw new InvalidArgumentException('Tax rate must not be negative!');
        }

        $grossPrice = $netPrice + ($netPrice * $taxRate);

        return round($grossPrice, 2);
    }
}
