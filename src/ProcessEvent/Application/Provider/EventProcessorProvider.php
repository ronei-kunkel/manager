<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Provider;

use Manager\ProcessEvent\Application\Mapper\EventProcessorMapper;
use Manager\ProcessEvent\Domain\Contract\EventProcessorInterface;
use Manager\ProcessEvent\Domain\Contract\EventInterface;
use Manager\ProcessEvent\Infra\Service\ClassInstantiatorService;

final class EventProcessorProvider
{
  public function __construct(
    private EventProcessorMapper $eventProcessorMapper,
    private ClassInstantiatorService $classInstantiatorService
  ) {
  }

  public function make(EventInterface $event): EventProcessorInterface
  {
    $eventProcessor = $this->eventProcessorMapper->of($event->getType());

    if(!$eventProcessor) {
      throw new \RuntimeException("Processor for " . $event->getType() . " event are not implemented or mapped.");
    }

    return $this->provideEventProcessor($eventProcessor, $event);
  }

  private function provideEventProcessor(string $className, EventInterface $event): EventProcessorInterface
  {
    /**
     * @var EventProcessorInterface
     */
    $processor = $this->classInstantiatorService->instantiate($className);

    $processor->setEvent($event);

    return $processor;
  }

}
