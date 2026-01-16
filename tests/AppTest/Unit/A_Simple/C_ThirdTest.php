<?php

declare(strict_types=1);

namespace AppTest\Unit\A_Simple;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class C_ThirdTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [true, true],
            [true, false],
        ];
    }

    #[DataProvider('dataProvider')]
    public function testSuccess(bool $value1, bool $value2): void
    {
        $this->assertSame($value1, $value2, "Annahme fehlgeschlagen, dass 'true' === 'true' ist.");
    }

    #[DataProvider('dataProvider')]
    public function testFail(bool $value1, bool $value2): void
    {
        $this->assertSame($value1, $value2, "Annahme fehlgeschlagen, dass 'false' === 'true' ist.");
    }
}
