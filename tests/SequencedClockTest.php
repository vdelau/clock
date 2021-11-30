<?php

namespace VdeLau\Clock;

use PHPUnit\Framework\TestCase;

class SequencedClockTest extends TestCase
{
    public function testManuallySequenced()
    {
        $sequence = $this->getTestSequence();
        $clock = new ManuallySequencedClock($sequence);
        foreach ($sequence as $atom => $dt) {
            $now = $clock->now();
            self::assertInstanceOf(\DateTimeInterface::class, $now);
            self::assertEquals($atom, $now->format(DATE_ATOM));

            $now = $clock->now();
            self::assertInstanceOf(\DateTimeInterface::class, $now);
            self::assertEquals($atom, $now->format(DATE_ATOM));

            $clock->tick();
        }

        $this->expectException(ClockStateException::class);

        $now = $clock->now();
    }

    /**
     * @return \DateTimeInterface[]
     * @throws \Exception
     */
    private function getTestSequence(): array
    {
        $tz = new \DateTimeZone('UTC');
        return [
            '2021-02-03T01:00:00+00:00' => new \DateTime('2021-02-03 01:00:00', $tz),
            '2021-02-03T02:00:00+00:00' => new \DateTimeImmutable('2021-02-03 02:00:00', $tz),
            '2021-02-03T03:00:00+00:00' => new \DateTime('2021-02-03 03:00:00', $tz),
        ];
    }

    public function testAutomaticallySequenced()
    {
        $sequence = $this->getTestSequence();
        $clock = new AutomaticallySequencedClock($sequence);
        foreach ($sequence as $atom => $dt) {
            $now = $clock->now();
            self::assertInstanceOf(\DateTimeInterface::class, $now);
            self::assertEquals($atom, $now->format(DATE_ATOM));
        }

        $this->expectException(ClockStateException::class);

        $now = $clock->now();
    }

    public function testClear()
    {
        $sequence = $this->getTestSequence();
        $clock = new ManuallySequencedClock($sequence);
        $clock->clear();

        $this->expectException(ClockStateException::class);

        $now = $clock->now();
    }
}
