<?php

declare(strict_types=1);

namespace AppTest\Unit\C_ClassWithDependencies;

use App\Entity\TaxRate;
use App\Service\GrossPriceCalculator;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Rinvex\Country\Country;

class B_SecondTest extends TestCase
{
    private MockObject|Country $countryMock;

    protected function setUp(): void
    {
        $this->countryMock = $this->createMock(Country::class);
    }

    private function getSUT(): GrossPriceCalculator
    {
        $this->countryMock
            ->method('getIsoAlpha3')
            ->willReturn('DEU');

        $taxRate = new TaxRate(
            'de_DE',
            0.19,
            $this->countryMock,
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
