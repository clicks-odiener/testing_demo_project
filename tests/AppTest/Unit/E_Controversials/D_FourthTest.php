<?php

declare(strict_types=1);

namespace AppTest\Unit\E_Controversials;

use App\Service\GrossPriceCalculatorSimple;
use PHPUnit\Framework\TestCase;

class D_FourthTest extends TestCase
{
    private function getSUT(): GrossPriceCalculatorSimple
    {
        return new GrossPriceCalculatorSimple();
    }

    public function testCalculateFromNetPrice(): void
    {
        $this->markTestSkipped('Can not be tested at the moment.');

        $grossPriceCalculator = $this->getSUT();

        $actualResult = $grossPriceCalculator->calculateFromNetPrice($netPrice);

        $this->assertSame($expectedResult, $actualResult);
    }
}
