<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Application;

use Manager\ProcessEvent\Application\Provider\EventProvider;
use Manager\ProcessEvent\Application\Provider\EventProcessorProvider;

final class ProcessEventHandler
{
  public function __construct(
  ) {
  }

  public function handle(ProcessEventInput $input): void
  {
    try {
      $event = EventProvider::make($input->type, $input->platform, $input->content);

      $processor = EventProcessorProvider::make($event);

      $processor->process();
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}
