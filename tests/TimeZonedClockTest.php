<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class TimeZonedClockTest extends TestCase
{
    public function testTimeZonedClock()
    {
        $tz_utc = new \DateTimeZone('UTC');
        $tz_ams = new \DateTimeZone('Europe/Amsterdam');
        $base_clock = new FixedClock(new \DateTime('now', $tz_ams));
        $now = $base_clock->now();
        self::assertEquals($tz_ams->getName(), $now->getTimezone()->getName());

        $clock = new TimeZonedClock($base_clock, $tz_utc);
        $now = $clock->now();

        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertEquals($tz_utc->getName(), $now->getTimezone()->getName());
    }

    public function testUTCClock()
    {
        $clock = new UTCClock(new SystemClock());
        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertEquals('UTC', $now->getTimezone()->getName());
    }

    public function testLocalClock()
    {
        $dt = new \DateTime();

        $clock = new LocalClock(new SystemClock());
        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertEquals($dt->getTimezone()->getName(), $now->getTimezone()->getName());
    }
}
