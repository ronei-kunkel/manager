<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application;

use Manager\ProcessEvent\Application\Provider\EventProvider;
use Manager\ProcessEvent\Application\Provider\EventProcessorProvider;
use Manager\ProcessEvent\Domain\Contract\EventInterface;

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

      // if(!$event) {
      //   // todo log 'Have no support for precess this event type yet: ' . $input->type
      // }

      if($event) {
        $this->eventProcessorProvider
          ->make($event)
          ->process();
      }

    } catch (\Throwable $th) {
      print_r($th->getMessage());
    }
  }
}
