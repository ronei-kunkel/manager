<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Mapper;

use Manager\ProcessEvent\Domain\Event\Ping\PingEventProcessor;

final class EventProcessorMapper
{

  protected array $map = [
    'ping' => PingEventProcessor::class
  ];

  public function of(string $eventType): ?string
  {
    if(!in_array($eventType, $this->map)) {
      return null;
    }

    return $this->map[$eventType];
  }
}