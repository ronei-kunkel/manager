<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Manager\Notification\Application\UseCase\RegisterGitHubEvent;
use Manager\Notification\Infra\Factory\EventFactory;

final class GitHubNotifyController
{
  public function __construct(
    private Request $request,
    private RegisterGitHubEvent $registerGitHubEvent,
    private EventFactory $eventFactory
  ){
  }

  public function __invoke(): JsonResponse
  {
    try {
      $data = $this->request->all();

      $eventInput = $this->eventFactory->createGitHubEvent($data);

      $output = $this->registerGitHubEvent->handle($eventInput);

      $data = [
        "message" => $output->message
      ];

      return new JsonResponse($data, $output->code);
    } catch (\Exception $e) {

      $message = $e->getCode() === 0 ? 'Internal server error' : $e->getMessage();
      $code    = $e->getCode() === 0 ? 500 : $e->getCode();

      $data = ['error' => $message];

      return new JsonResponse($data, $code);
    }
  }
}