<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application;

use Manager\ProcessEvent\Application\Provider\EventProvider;
use Manager\ProcessEvent\Application\Provider\EventProcessorProvider;
use Manager\ProcessEvent\Domain\Contract\EventInterface;
use Manager\ProcessEvent\Domain\Contract\EventProcessorInterface;

final class ProcessEventHandler
{
  public function __construct(
    private EventProvider $eventProvider,
    private EventProcessorProvider $eventProcessorProvider
  ) {
  }

  public function handle(ProcessEventInput $input): void
  {
    try {
      /**
       * @var EventInterface
       */
      $event = $this->eventProvider
        ->make($input);

      $eventProcessor = $this->eventProcessorProvider
        ->make($event);

      /**
       * @var EventProcessorInterface
       */
      $eventProcessor->process();

    } catch (\Throwable $th) {
      print_r($th->getMessage());
    }
  }
}
