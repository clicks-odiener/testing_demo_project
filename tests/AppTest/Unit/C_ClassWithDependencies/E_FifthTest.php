<?php

declare(strict_types=1);

namespace AppTest\Unit\C_ClassWithDependencies;

use App\Service\GrossPriceCalculatorSimple;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class E_FifthTest extends TestCase
{
    private function getSUT(): GrossPriceCalculatorSimple
    {
        return new GrossPriceCalculatorSimple();
    }

    public static function dataProviderTestCalculateFromNetPrice(): Generator
    {
        $netPrice = 100.0;
        $expectedGrossPrice =  $netPrice + ($netPrice * GrossPriceCalculatorSimple::TAX_RATE);

        yield [$netPrice, $expectedGrossPrice];
    }

    #[DataProvider('dataProviderTestCalculateFromNetPrice')]
    public function testCalculateFromNetPrice(float $netPrice, float $expectedResult): void
    {
        $grossPriceCalculator = $this->getSUT();

        $actualResult = $grossPriceCalculator->calculateFromNetPrice($netPrice);

        $this->assertSame($expectedResult, $actualResult);
    }
}
