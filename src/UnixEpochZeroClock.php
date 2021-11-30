<?php

declare(strict_types=1);

namespace VdeLau\Clock;

/**
 * Always return the UNIX epoch timestamp of 1970-01-01 00:00:00 UTC
 */
class UnixEpochZeroClock extends FixedClock
{
    public function __construct()
    {
        parent::__construct(new \DateTimeImmutable('@0', new \DateTimeZone('UTC')));
    }
}
