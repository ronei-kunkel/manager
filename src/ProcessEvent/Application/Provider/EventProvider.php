<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application\Provider;

use Manager\ProcessEvent\Application\Mapper\EventFactoryMapper;
use Manager\ProcessEvent\Application\ProcessEventInput;
use Manager\ProcessEvent\Domain\Base\Event;
use Manager\ProcessEvent\Infra\Service\ClassInstantiatorService;
use Manager\ProcessEvent\Domain\Contract\EventFactoryInterface;

final class EventProvider
{
  public function __construct(
    private ClassInstantiatorService $classInstantiatorService,
    private EventFactoryMapper $eventFactoryMapper
  ) {
  }

  public function make(ProcessEventInput $input): Event
  {
    $eventFactory = $this->eventFactoryMapper->of($input->type);

    if(!$eventFactory) {
      throw new \RuntimeException("Factory for " . $input->type . " event are not implemented or mapped.");
    }

    return $this->provideEvent($eventFactory, $input);
  }

  private function provideEvent(string $className, ProcessEventInput $input): Event
  {
    /**
     * @var EventFactoryInterface
     */
    $factory = $this->classInstantiatorService->instantiate($className);

    return $factory->make($input->type, $input->platform, $input->content);
  }
}
