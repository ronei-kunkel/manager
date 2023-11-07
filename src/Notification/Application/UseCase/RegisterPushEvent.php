<?php declare(strict_types=1);

namespace Manager\Notification\Application\UseCase;

use Manager\Notification\Application\Output;
use Manager\Notification\Domain\Entity\Event\Push;
use Manager\Notification\Infra\Persistence\PushEventPersister;

final class RegisterPushEvent
{
  public function __construct(
    private PushEventPersister $pushEventPersister,
    // private PushEventEnqueuer $pushEventEnqueuer,
  ) {
  }

  public function handle(Push $event): Output
  {
    try {

      $this->pushEventPersister->persist($event);

      // $this->pushEventEnqueuer->push($event);

      return new Output(200);

    } catch (\Throwable $th) {
      return new Output(500, $th->getMessage());
    }
  }
}
