<?php

declare(strict_types=1);

namespace AppTest\Unit\A_Simple;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class D_FourthTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [true, true],
            [true, false],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testIsSame($value1, $value2): void
    {
        $this->assertSame(
            $value1,
            $value2,
            sprintf(
                "Annahme fehlgeschlagen, dass '%s' === '%s' ist.",
                $value1 ? 'true' : 'false',
                $value2 ? 'true' : 'false',
            ));
    }
}
