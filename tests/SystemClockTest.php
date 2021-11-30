<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class SystemClockTest extends TestCase
{
    public function testNow()
    {
        $clock = new SystemClock();
        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);

        $next = $clock->now();
        self::assertNotSame($now, $next);
    }
}
