<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * Facade for any PSR\Clock implementation to always return a DateTimeImmutable in the default timezone.
 */
class LocalClock extends TimeZonedClock
{
    public function __construct(ClockInterface $clock)
    {
        $tz = (new \DateTimeImmutable())->getTimezone();
        parent::__construct($clock, $tz);
    }
}
