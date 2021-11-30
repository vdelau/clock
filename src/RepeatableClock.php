<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * RepeatableClock is a facade that will always return a new DateTimeImmutable for the same timestamp of the first call to now().
 */
class RepeatableClock implements ClockInterface
{
    private \DateTimeImmutable $datetime;
    private ClockInterface $clock;

    public function __construct(ClockInterface $clock)
    {
        $this->clock = $clock;
    }

    public function now(): \DateTimeImmutable
    {
        // Save the first call to the clock
        if (!$this->datetime instanceof \DateTimeImmutable) {
            $this->datetime = $this->clock->now();
        }
        // Return a fresh copy every call
        return \DateTimeImmutable::createFromInterface($this->datetime);
    }
}
