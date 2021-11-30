<?php

declare(strict_types=1);

namespace VdeLau\Clock;

/**
 * Manually steps through the provided DateTimeImmutables
 */
class ManuallySequencedClock extends AbstractSequencedClock
{
    public function now(): \DateTimeImmutable
    {
        return $this->current();
    }

    /**
     * Move the clock to the next entry in the sequence.
     *
     * @throws ClockStateException
     */
    public function tick(): void
    {
        $this->next();
    }
}
