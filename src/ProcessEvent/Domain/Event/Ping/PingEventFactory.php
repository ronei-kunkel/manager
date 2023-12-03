<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Domain\Event\Ping;

use Manager\ProcessEvent\Domain\Contract\EventFactoryInterface;

final class PingEventFactory implements EventFactoryInterface
{
  public function __construct(
    // api service
  ) {
  }

  public function make(string $type, string $platform, array $content): PingEvent
  {
    return new PingEvent($type, $platform, $content);
  }
}
