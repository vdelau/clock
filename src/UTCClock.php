<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * Facade for any PSR\Clock implementation to always return a DateTimeImmutable in the UTC timezone.
 */
class UTCClock extends TimeZonedClock implements ClockInterface
{
    public function __construct(ClockInterface $clock)
    {
        parent::__construct($clock, new \DateTimeZone('UTC'));
    }
}
