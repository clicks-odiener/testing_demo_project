<?php

declare(strict_types=1);

namespace AppTest\Unit\B_SimpleClass;

use App\Service\KreissegmentService;
use PHPUnit\Framework\TestCase;

class D_FourthTest extends TestCase
{
    private function getSUT(): KreissegmentService
    {
        return new KreissegmentService(
            10,
            null,
            null,
            5
        );
    }

    public function testBerechneKreissegment(): void
    {
        $kreissegmentService = $this->getSUT();

        $actualResult = $kreissegmentService->berechneKreissegment();

        $this->assertSame(['some fancy data'], $actualResult);
    }

    public function testBerechneKreissegment2(): void
    {
        $kreissegmentService = $this->getSUT();

        $actualResult = $kreissegmentService->berechneKreissegment2();

        $this->assertSame(['some fancy data'], $actualResult);
    }
}
