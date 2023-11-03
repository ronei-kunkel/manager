<?php declare(strict_types=1);

namespace Manager\Notification\Application\Factory;

use Manager\Notification\Application\Builder\GitHubPushEventBuilder;
use Manager\Notification\Domain\Entity\Event\Push;

final class GitHubPushEventFactory
{
  private Push $push;

  public function __construct(
    private GitHubPushEventBuilder $gitHubPushEventBuilder
  ) {
  }

  public function __invoke(array $data): Push
  {
    $pushEvent = $this->gitHubPushEventBuilder->withData($data);

    return $pushEvent->build();
  }
}
