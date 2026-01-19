<?php

declare(strict_types=1);

namespace AppTest\Unit\D_ExceptionTesting;

use App\Service\GrossPriceCalculatorWithException;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class A_FirstTest extends TestCase
{
    public function testCalculateFromNetPrice(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tax rate must not be negative!');

        $grossPriceCalculator = new GrossPriceCalculatorWithException();
        $grossPriceCalculator->calculateFromNetPrice(100.0, -10.0);
    }
}
