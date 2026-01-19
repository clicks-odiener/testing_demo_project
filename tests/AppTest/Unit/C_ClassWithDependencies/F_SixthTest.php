<?php

declare(strict_types=1);

namespace AppTest\Unit\C_ClassWithDependencies;

use App\Entity\TaxRate;
use App\Service\GrossPriceCalculator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class F_SixthTest extends TestCase
{
    private MockObject|TaxRate $taxRateMock;

    protected function setUp(): void
    {
        $this->taxRateMock = $this->createMock(TaxRate::class);
    }

    private function getSUT(): GrossPriceCalculator
    {
        return new GrossPriceCalculator($this->taxRateMock);
    }

    public function testCalculateFromNetPrice(): void
    {
        $customTaxRate = 0.7;

        $this->taxRateMock->expects($this->once())
            ->method('setRate')
            ->with($customTaxRate)
            ->willReturn($this->taxRateMock);

        $grossPriceCalculator = $this->getSUT();

        $grossPriceCalculator->calculateFromNetPriceWithCustomTaxRate(586.0, $customTaxRate);
    }
}
