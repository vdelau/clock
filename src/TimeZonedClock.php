<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * Facade for any PSR\Clock implementation to always return a DateTimeImmutable in a specific timezone.
 */
class TimeZonedClock implements ClockInterface
{
    private ClockInterface $clock;
    private \DateTimeZone $timeZone;

    public function __construct(ClockInterface $clock, \DateTimeZone $timeZone)
    {
        $this->clock = $clock;
        $this->timeZone = $timeZone;
    }

    public function now(): \DateTimeImmutable
    {
        $dt = $this->clock->now();
        return $dt->setTimezone($this->timeZone);
    }
}
