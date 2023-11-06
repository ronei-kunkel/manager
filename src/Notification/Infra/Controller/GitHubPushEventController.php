<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Manager\Notification\Application\Factory\GitHubEventInputFactory;
use Manager\Notification\Application\UseCase\RegisterGitHubPushEvent;

final class GitHubPushEventController
{
  public function __construct(
    private Request $request,
    private GitHubEventInputFactory $gitHubEventInputFactory,
    private RegisterGitHubPushEvent $registerGitHubEvent
  ){
  }

  public function __invoke(): JsonResponse
  {
    try {
      $data = $this->request->all();

      $event = $this->gitHubEventInputFactory->createPushEvent($data);

      $output = $this->registerGitHubEvent->handle($event);

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