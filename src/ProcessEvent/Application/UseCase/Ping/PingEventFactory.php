<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\UseCase\Ping;

use Manager\ProcessEvent\Application\Contract\EventProviderInterface;
use Manager\ProcessEvent\Domain\Entity\PingEvent;

final class PingEventFactory implements EventProviderInterface
{
  public function __construct(
  ) {
  }

  public function make(string $type, string $platform, array $content): PingEvent
  {
    $pingEvent = new PingEvent($type, $platform, $content);

    return $pingEvent;
  }
}
