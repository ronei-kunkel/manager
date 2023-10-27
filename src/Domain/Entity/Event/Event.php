<?php declare(strict_types=1);

namespace Manager\Domain\Entity\Event;

use Manager\Domain\Entity\Platform\Platform;

abstract class Event
{
  abstract public function hash(): string;
  abstract public function platform(): Platform;
}