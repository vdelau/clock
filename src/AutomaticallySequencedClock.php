<?php

declare(strict_types=1);

namespace VdeLau\Clock;

/**
 * Automatically steps through the provided DateTimeImmutables
 */
class AutomaticallySequencedClock extends AbstractSequencedClock
{
    public function now(): \DateTimeImmutable
    {
        return $this->next();
    }
}
