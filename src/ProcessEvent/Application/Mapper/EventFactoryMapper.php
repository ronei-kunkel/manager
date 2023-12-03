<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Mapper;

use Manager\ProcessEvent\Domain\Event\Ping\PingEventFactory;

final class EventFactoryMapper
{

  protected array $map = [
    'ping' => PingEventFactory::class
  ];

  public function of(string $eventType): ?string
  {
    if(!in_array($eventType, $this->map)) {
      return null;
    }

    return $this->map[$eventType];
  }
}