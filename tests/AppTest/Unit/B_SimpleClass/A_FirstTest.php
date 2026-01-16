<?php

declare(strict_types=1);

namespace AppTest\Unit\B_SimpleClass;

use App\Service\MathService;
use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class A_FirstTest extends TestCase
{
    public static function dataProviderTestSum(): Generator
    {
        yield [47, 3, 50];
        yield [78, 7, 85];
    }

    #[DataProvider('dataProviderTestSum')]
    public function testSum(int $a, int $b, int $expectedResult): void
    {
        $mathService = new MathService();

        $actualResult = $mathService->sum($a, $b);

        $this->assertSame($expectedResult, $actualResult);
    }
}

// was ist ein SUT?
// Konstanten
// pirvate Methoden
// Pre Commit Hook
// Github Action
// Code Coverage