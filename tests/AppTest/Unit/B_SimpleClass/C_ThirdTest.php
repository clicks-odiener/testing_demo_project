<?php

declare(strict_types=1);

namespace AppTest\Unit\B_SimpleClass;

use App\Service\KreissegmentService;
use PHPUnit\Framework\TestCase;

class C_ThirdTest extends TestCase
{
    public function testBerechneKreissegment(): void
    {
        $kreissegmentService = new KreissegmentService(
            10,
            null,
            null,
            5
        );

        $actualResult = $kreissegmentService->berechneKreissegment();

        $this->assertSame(['some fancy data'], $actualResult);
    }

    public function testBerechneKreissegment2(): void
    {
        $kreissegmentService = new KreissegmentService(
            10,
            null,
            null,
            5
        );

        $actualResult = $kreissegmentService->berechneKreissegment2();

        $this->assertSame(['some fancy data'], $actualResult);
    }
}
