<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * Provides the current system time every time.
 */
class SystemClock implements ClockInterface
{
    public function now(): \DateTimeImmutable
    {
        return new \DateTimeImmutable();
    }
}
