<?php

declare(strict_types=1);

namespace AppTest\Unit\A_Simple;

use PHPUnit\Framework\TestCase;

class B_SecondTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->assertSame(true, true, "Annahme fehlgeschlagen, dass 'true' === 'true' ist.");
    }

    public function testFail(): void
    {
        $this->assertSame(true, false, "Annahme fehlgeschlagen, dass 'false' === 'true' ist.");
    }
}
