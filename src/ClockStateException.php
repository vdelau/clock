<?php

declare(strict_types=1);

namespace VdeLau\Clock;

/**
 * ClockStateException is thrown when a clock is missing enough configuration or state to be able to function.
 *
 * This can be that current time is not set or a sequence ran out.
 */
class ClockStateException extends \Exception
{
}
