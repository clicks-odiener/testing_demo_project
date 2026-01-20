<?php

declare(strict_types=1);

namespace AppTest\Unit\A_Simple;

use Generator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class E_FifthTest extends TestCase
{
    public static function dataProvider(): Generator
    {
        yield [true, true];
        yield [true, false];
    }

    #[DataProvider('dataProvider')]
    public function testSuccess(bool $value1, bool $value2): void
    {
        $this->assertSame(
            $value1,
            $value2,
            sprintf(
                $value1 ? 'true' : 'false',
                $value2 ? 'true' : 'false',
            ));
    }
}
