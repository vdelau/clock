<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class RepeatableClockTest extends TestCase
{

    public function testNow()
    {
        $base_clock = new ManualClock(new \DateTime('2021-03-14 12:34:56'));
        $clock = new RepeatableClock($base_clock);

        $first = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $first);

        $base_clock->addSeconds(60);

        $second = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $second);
        self::assertEquals($first, $second);

        self::assertNotSame($first, $second);
    }
}
