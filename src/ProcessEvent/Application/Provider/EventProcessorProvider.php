<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Provider;

use Manager\ProcessEvent\Domain\Contract\EventProcessorInterface;
use Manager\ProcessEvent\Domain\Contract\EventInterface;
use Manager\ProcessEvent\Infra\Service\ClassInstantiatorService;

final class EventProcessorProvider
{
  public function __construct(
    private ClassInstantiatorService $classInstantiatorService
  ) {
  }

  public function make(EventInterface $event): EventProcessorInterface
  {
    return $this->provideEventProcessor($event->processor(), $event);
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
