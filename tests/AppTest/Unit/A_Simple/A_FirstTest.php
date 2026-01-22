<?php

declare(strict_types=1);

namespace AppTest\Unit\A_Simple;

use PHPUnit\Framework\TestCase;

class A_FirstTest extends TestCase
{
    public function testSuccess(): void
    {
        $this->assertSame(true, false);
    }

    public function testFail(): void
    {
        $this->assertSame(true, false);
    }
}
