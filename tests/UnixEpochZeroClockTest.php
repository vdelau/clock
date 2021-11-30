<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class UnixEpochZeroClockTest extends TestCase
{
    public function testNow()
    {
        $epoch = '1970-01-01T00:00:00+00:00';

        $clock = new UnixEpochZeroClock();
        $now = $clock->now();
        self::assertInstanceOf(\DateTimeImmutable::class, $now);
        self::assertEquals('0', $now->format('U'));
        self::assertEquals($epoch, $now->format(DATE_ATOM));
    }
}
