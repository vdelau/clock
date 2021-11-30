<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

class MultipliedClock implements ClockInterface
{
    private ClockInterface $clock;
    private float $base;
    private float $multiplier;

    public function __construct(float $multiplier, ClockInterface|null $clock = null)
    {
        $this->clock = $clock ?: new SystemClock();

        $this->base = $this->getMicroTimeFromClock();

        $this->multiplier = $multiplier;
    }

    private function getMicroTimeFromClock(): float
    {
        $dt = $this->clock->now();
        $ts = $dt->format('U.u');
        return floatval($ts);
    }

    public function now(): \DateTimeImmutable
    {
        $now = $this->getMicroTimeFromClock();
        $real_diff = $now - $this->base;
        $ts = $this->base + ($real_diff * $this->multiplier);
        return new \DateTimeImmutable(sprintf('@%f', $ts));
    }
}
