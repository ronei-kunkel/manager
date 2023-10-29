<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Manager\Notification\Application\Builder\EventBuilder;
use Manager\Notification\Application\UseCase\CreatePushEventNotification;

final class GitHubPushEventController
{
  public function __construct(
    private Request $request,
    private EventBuilder $eventBuilder,
    private CreatePushEventNotification $createPushEventNotification
  ) {
  }

  public function __invoke(): JsonResponse
  {
    try {

      $gitHubPushEvent = $this->eventBuilder
        ->fromGitHub($this->request->all())
        ->defineGitHubPushEvent()
        ->build();

      $output = $this->createPushEventNotification->handle($gitHubPushEvent);

      $body = [
        "message" => $output->message
      ];

      return new JsonResponse($body, $output->code);
    } catch (\Exception $e) {
      $message = [
        'error' => $e->getMessage(),
      ];
      return new JsonResponse($message, $e->getCode());
    }
  }
}