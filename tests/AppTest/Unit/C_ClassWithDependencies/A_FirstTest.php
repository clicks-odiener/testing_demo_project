<?php

declare(strict_types=1);

namespace AppTest\Unit\C_ClassWithDependencies;

use App\Entity\TaxRate;
use App\Service\GrossPriceCalculator;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class A_FirstTest extends TestCase
{
    private function getSUT(): GrossPriceCalculator
    {
        $country = country('de');

        $taxRate = new TaxRate(
            'de_DE',
            0.19,
            $country,
        );

        return new GrossPriceCalculator($taxRate);
    }

    public static function dataProviderTestCalculateFromNetPrice(): Generator
    {
        yield [100, 119.0];
    }

    #[DataProvider('dataProviderTestCalculateFromNetPrice')]
    public function testCalculateFromNetPrice(float $netPrice, $expectedResult): void
    {
        $grossPriceCalculator = $this->getSUT();

        $actualResult = $grossPriceCalculator->calculateFromNetPrice($netPrice);

        $this->assertSame($expectedResult, $actualResult);
    }
}
