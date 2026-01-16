<?php

declare(strict_types=1);

namespace AppTest\Unit\C_ClassWithDependencies;

use App\Entity\TaxRate;
use App\Service\GrossPriceCalculator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use ReflectionException;
use Rinvex\Country\Country;

class D_FourthTest extends TestCase
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

    /**
     * @throws ReflectionException
     */
    public function testCalculateFromNetPrice(): void
    {
        $grossPriceCalculator = $this->getSUT();

        $actualResult = $this->callPrivateMethod($grossPriceCalculator, 'doSomethingNasty');

        $this->assertSame('Something nasty was done!', $actualResult);
    }

    /**
     * @throws ReflectionException
     */
    public function callPrivateMethod($obj, $name, array $args = [])
    {
        $class = new ReflectionClass($obj);
        $method = $class->getMethod($name);

        return $method->invokeArgs($obj, $args);
    }
}
