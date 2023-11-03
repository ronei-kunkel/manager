<?php declare(strict_types=1);

namespace Manager\Shared\Application\Contract;

use Manager\Shared\Domain\Contract\Event;

interface EventBuilder
{
  public function withData(array $notificationData): self;
  public function build(): Event;
}