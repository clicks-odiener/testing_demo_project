<?php

declare(strict_types=1);

namespace AppTest\Unit\B_SimpleClass;

use App\Service\MathService;
use Generator;
use PHPUnit\Framework\TestCase;

class B_SecondTest extends TestCase
{
    public static function dataProviderTestSum(): Generator
    {
        yield [47, 3, 50];
        yield [78, 7, 85];
    }

    /**
     * @dataProvider dataProviderTestSum
     */
    public function testSum(int $a, int $b, int $expectedResult): void
    {
        $mathService = new MathService();

        $actualResult = $mathService->sum($a, $b);

        $this->assertSame($expectedResult, $actualResult);
    }

    public static function dataProviderTestProduct(): Generator
    {
        yield [5, 3, 15];
        yield [2, 10, 20];
    }

    /**
     * @dataProvider dataProviderTestSum
     */
    public function testProduct(int $a, int $b, int $expectedResult): void
    {
        $mathService = new MathService();

        $actualResult = $mathService->product($a, $b);

        $this->assertSame($expectedResult, $actualResult);
    }
}
