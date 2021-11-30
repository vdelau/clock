<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * ManualClock is a clock implementation that needs outside control to progress in time.
 */
class ManualClock implements ClockInterface
{
    private \DateTimeImmutable $current;

    public function __construct(\DateTimeInterface|null $datetime = null)
    {
        $this->setDateTime($datetime);
    }

    /**
     * Internal helper function to return the current time or throw an exception
     *
     * @return \DateTimeImmutable
     * @throws ClockStateException
     */
    private function getCurrent(): \DateTimeImmutable
    {
        if (!$this->current instanceof \DateTimeImmutable) {
            throw new ClockStateException();
        }
        return $this->current;
    }

    public function now(): \DateTimeImmutable
    {
        return $this->getCurrent();
    }

    /**
     * Set the new current time for this clock.
     *
     * @param \DateTimeInterface $datetime
     */
    public function setDateTime(\DateTimeInterface $datetime): void
    {
        $this->current = \DateTimeImmutable::createFromInterface($datetime);
    }

    /**
     * Add a DateInterval to the current time.
     *
     * @param \DateInterval $interval
     *
     * @throws ClockStateException
     */
    public function addInterval(\DateInterval $interval): void
    {
        $this->current = $this->getCurrent()->add($interval);
    }

    /**
     * Add a number of seconds to the current time.
     *
     * @param int $seconds
     *
     * @throws ClockStateException
     */
    public function addSeconds(int $seconds): void
    {
        $interval = new \DateInterval(sprintf('PT%uS', $seconds));
        $this->addInterval($interval);
    }

    /**
     * Subtract a DateInterval from the current time.
     *
     * @param \DateInterval $interval
     *
     * @throws ClockStateException
     */
    public function subtractInterval(\DateInterval $interval): void
    {
        $this->current = $this->getCurrent()->sub($interval);
    }

    /**
     * Subtract a number of seconds from the current time.
     *
     * @param int $seconds
     *
     * @throws ClockStateException
     */
    public function subtractSeconds(int $seconds): void
    {
        $interval = new \DateInterval(sprintf('PT%uS', $seconds));
        $this->subtractInterval($interval);
    }
}
