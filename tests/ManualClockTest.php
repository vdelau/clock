<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class ManualClockTest extends TestCase
{
    private const TEST_TS = '2021-02-03 12:00:00';
    private const TEST_TS_ATOM = '2021-02-03T12:00:00+00:00';

    private const TEST_INTERVAL_SEC = 1800;
    private const TEST_INTERVAL_ISO = 'PT30M';

    private const TEST_ADD_TS_ATOM = '2021-02-03T12:30:00+00:00';
    private const TEST_SUB_TS_ATOM = '2021-02-03T11:30:00+00:00';

    public function testAddInterval()
    {
        $dt = new \DateTime(self::TEST_TS, new \DateTimeZone('UTC'));

        $clock = new ManualClock($dt);
        $interval = new \DateInterval('PT30M');
        $clock->addInterval($interval);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeInterface::class, $now);
        self::assertEquals(self::TEST_ADD_TS_ATOM, $now->format(DATE_ATOM));
    }

    public function testSubtractSeconds()
    {
        $dt = new \DateTime(self::TEST_TS, new \DateTimeZone('UTC'));

        $clock = new ManualClock($dt);
        $clock->subtractSeconds(self::TEST_INTERVAL_SEC);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeInterface::class, $now);
        self::assertEquals(self::TEST_SUB_TS_ATOM, $now->format(DATE_ATOM));
    }

    public function testSetDateTime()
    {
        $dt = new \DateTime(self::TEST_TS, new \DateTimeZone('UTC'));

        $clock = new ManualClock();
        $clock->setDateTime($dt);
        $now = $clock->now();

        self::assertInstanceOf(\DateTimeInterface::class, $now);
        self::assertEquals(self::TEST_TS_ATOM, $now->format(DATE_ATOM));
    }

    public function testSubtractInterval()
    {
        $dt = new \DateTime(self::TEST_TS, new \DateTimeZone('UTC'));

        $clock = new ManualClock($dt);
        $interval = new \DateInterval('PT30M');
        $clock->subtractInterval($interval);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeInterface::class, $now);
        self::assertEquals(self::TEST_SUB_TS_ATOM, $now->format(DATE_ATOM));
    }

    public function testNow()
    {
        $dt = new \DateTime(self::TEST_TS, new \DateTimeZone('UTC'));

        $clock = new ManualClock($dt);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeInterface::class, $now);
        self::assertEquals(self::TEST_TS_ATOM, $now->format(DATE_ATOM));
    }

    public function testAddSeconds()
    {
        $dt = new \DateTime(self::TEST_TS, new \DateTimeZone('UTC'));

        $clock = new ManualClock($dt);
        $interval = new \DateInterval('PT30M');
        $clock->addSeconds(self::TEST_INTERVAL_SEC);

        $now = $clock->now();
        self::assertInstanceOf(\DateTimeInterface::class, $now);
        self::assertEquals(self::TEST_ADD_TS_ATOM, $now->format(DATE_ATOM));
    }

    public function testMissingTime()
    {
        $clock = new ManualClock();

        $this->expectException(ClockStateException::class);

        $clock->now();
    }
}
