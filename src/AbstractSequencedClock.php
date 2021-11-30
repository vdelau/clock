<?php

declare(strict_types=1);

namespace VdeLau\Clock;

use Psr\Clock\ClockInterface;

/**
 * Base class for a family of sequenced clock, where the clock steps through a provided set of DateTimeImmutables
 */
abstract class AbstractSequencedClock implements ClockInterface
{
    /** @var \DateTimeImmutable[] */
    protected array $sequence = [];

    /**
     * @param \DateTimeInterface[] $sequence
     */
    public function __construct(array $sequence = [])
    {
        $this->appendSequence($sequence);
    }

    /**
     * Clear the current sequence
     */
    public function clear(): void
    {
        $this->sequence = [];
    }

    /**
     * Append a single DateTimeImmutable to the sequence.
     *
     * @param \DateTimeInterface $datetime
     */
    public function append(\DateTimeInterface $datetime): void
    {
        $this->sequence[] = \DateTimeImmutable::createFromInterface($datetime);
    }

    /**
     * Append a sequence of DateTimeImmutables to the sequence
     *
     * @param \DateTimeInterface[] $sequence
     */
    public function appendSequence(array $sequence)
    {
        foreach ($sequence as $datetime) {
            $this->append($datetime);
        }
    }

    /**
     * Get the current entry in the sequence, which is the first entry of the sequence
     *
     * @return \DateTimeImmutable
     * @throws ClockStateException
     */
    protected function current(): \DateTimeImmutable
    {
        if (count($this->sequence) === 0) {
            throw new ClockStateException();
        }
        return $this->sequence[0];
    }

    /**
     * Make the next entry in the sequence the current entry, and return the previous entry.
     *
     * @return \DateTimeImmutable
     * @throws ClockStateException
     */
    protected function next(): \DateTimeImmutable
    {
        if (count($this->sequence) === 0) {
            throw new ClockStateException();
        }
        return array_shift($this->sequence);
    }
}
