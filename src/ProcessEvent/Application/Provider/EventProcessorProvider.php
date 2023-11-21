<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Provider;

use Manager\ProcessEvent\Application\Contract\EventProcessorInterface;
use Manager\ProcessEvent\Application\UseCase\Ping\PingEventProcessor;
use Manager\ProcessEvent\Domain\Contract\EventInterface;

use function Hyperf\Support\make;

final class EventProcessorProvider
{
  private static function systemMakeEventProcessor(string $classname, EventInterface $event): EventProcessorInterface
  {
    $processor = make($classname);

    $processor->setEvent($event);

    return $processor;
  }

  public static function make(EventInterface $event): EventProcessorInterface
  {
    switch ($event->getType()) {
      case 'ping':
        return self::systemMakeEventProcessor(PingEventProcessor::class, $event);

      default:
        throw new \Exception('Event Processor not implemented');
    }
  }

}
