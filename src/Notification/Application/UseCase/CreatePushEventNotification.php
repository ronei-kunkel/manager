<?php declare(strict_types=1);

namespace Manager\Notification\Application\UseCase;

use Manager\Notification\Domain\Entity\Event\GitHub\Push;
use Manager\Notification\Domain\Entity\Notification;
use Manager\Shared\Application\UseCase\Output;

final class CreatePushEventNotification
{
  public function __construct(
  ) {
  }

  public function handle(Push $push): Output
  {

    try {
      $notification = new Notification(null, $push, $push->platform(), $push->repository());

    } catch (\Throwable $th) {
      //throw $th;
    }

    return new Output(501, 'Not implemented yet');
  }
}