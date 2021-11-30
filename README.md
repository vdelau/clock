# Psr\Clock implementations

This repository provides a couple of `Psr\Clock` implementations, based on the draft PSR. This currently is not a package, it might become a package when the PSR is accepted.

## System time

`SystemClock` is the most simple `Psr\Clock` implementation that always will return the current systemtime. It essential replaces `new \DateTimeImmuitable()`.

## Timezone correction

`TimeZonedClock` and its descendants `UTCClock` and `LocalClock` are facades for other clock that will convert any clocks output to the desired timezone.

```php
// $utc_clock->now() will always return a DateTimeImmutable in the UTC timezone
$utc_clock = new UTCClock(new SystemClock());

// $my_clock->now() will always return a DateTimeImmutable in the Europe/Amsterdam timezone
$my_clock = new TimeZonedClock(new SystemClock(), new DateTimeZone('Europe/Amsterdam'));
```

## Stuck in time
`FixedClock` will always return a DateTimeImmutable for the same date and time provided in the constructor.

`RepeatableClock` will always return a DateTimeImmutable for the same date and time, obtained on the first call to `now()`

`UnixEpochClock` will always return a DateTimeImmutable for the UNIX epoch 1970-01-01 00:00:00 UTC.


## Controlled clocks
`ManualClock` allows manual control over the DateTimeImmutable that is returned. It has convenience functions to add or subtract time intervals.

Sequenced clock allow the user to provide a list of DateTimeInterface object that will be returned in sequence. `ManuallySequencedClock` progresses to the next provided DateTimeImmutable when calling tick. `AutomaticallyProgressingClock` will progress to the next entry when calling `now()`.


