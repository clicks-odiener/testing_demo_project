<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\TaxRate;

class GrossPriceCalculator
{
    public function __construct(
        private readonly TaxRate $taxRate,
        private readonly int $precision = 2
    ) {
    }

    public function calculateFromNetPrice(float $netPrice): float
    {
        $grossPrice = $netPrice + ($netPrice * $this->taxRate->getRate());

        return round($grossPrice, $this->precision);
    }

    private function doSomethingNasty(): string
    {
        return 'Something nasty was done!';
    }
}
