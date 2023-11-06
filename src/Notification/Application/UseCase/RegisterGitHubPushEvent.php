<?php declare(strict_types=1);

namespace Manager\Notification\Application\UseCase;

use Manager\Notification\Application\NotificationOutput;
use Manager\Notification\Domain\Entity\Event\Push;

final class RegisterGitHubPushEvent
{
  public function __construct(
  ) {
  }

  public function handle(Push $event): NotificationOutput
  {
    return new NotificationOutput(501, 'Not implemented yet');

    try {
    } catch (\Throwable $th) {
      //throw $th;
    }
  }
}