<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class FixedClockTest extends TestCase
{
    public function testFixedClock()
    {
        $dt = new \DateTime('2021-03-14 12:34:56', new \DateTimeZone('UTC'));

        $clock = new FixedClock($dt);
        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertNotSame($dt, $now);
    }
}
