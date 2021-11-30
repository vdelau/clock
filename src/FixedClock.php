<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * FixedClock always returns a new DateTimeImmutable for the same timestamp.
 */
class FixedClock implements ClockInterface
{
    private \DateTimeImmutable $datetime;

    public function __construct(\DateTimeInterface $datetime)
    {
        $this->datetime = \DateTimeImmutable::createFromInterface($datetime);
    }

    public function now(): \DateTimeImmutable
    {
        // Return a fresh copy every call
        return \DateTimeImmutable::createFromInterface($this->datetime);
    }
}
