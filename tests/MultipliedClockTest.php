<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class MultipliedClockTest extends TestCase
{

    public function testNow()
    {
        $base_clock = new ManualClock(new \DateTime('2021-02-03 12:00:00', new \DateTimeZone('UTC')));
        $clock = new MultipliedClock(30, $base_clock);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertEquals('2021-02-03T12:00:00+00:00', $now->format(DATE_ATOM));

        $base_clock->addSeconds(20);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertEquals('2021-02-03T12:10:00+00:00', $now->format(DATE_ATOM));
    }
}
