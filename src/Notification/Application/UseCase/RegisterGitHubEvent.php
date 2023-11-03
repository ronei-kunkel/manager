<?php declare(strict_types=1);

namespace Manager\Notification\Application\UseCase;

use Manager\Notification\Application\NotificationOutput;
use Manager\Notification\Application\RegisterPushNotifyInput;
use Manager\Shared\Domain\Contract\Event;

final class RegisterGitHubEvent
{
  public function __construct(
  ) {
  }

  public function handle(Event $event): NotificationOutput
  {

    try {
    } catch (\Throwable $th) {
      //throw $th;
    }

    return new NotificationOutput(501, 'Not implemented yet');
  }
}