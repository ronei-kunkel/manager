<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Controller;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Manager\Notification\Application\Factory\GitHubEventInputFactory;
use Manager\Notification\Application\UseCase\RegisterPushEvent;

final class GitHubPushEventController
{
  public function __construct(
    private Request $request,
    private GitHubEventInputFactory $gitHubEventInputFactory,
    private RegisterPushEvent $registerPushEvent
  ){
  }

  public function __invoke(): JsonResponse
  {
    try {
      $data = $this->request->all();

      $event = $this->gitHubEventInputFactory->createPushEvent($data);

      $output = $this->registerPushEvent->handle($event);

      $data = null;

      if(!is_null($output->message)){
        $data = ['message' => $output->message];
      }

      return new JsonResponse($data, $output->code);
    } catch (\Exception $e) {

      $message = $e->getCode() === 0 ? 'Internal server error' : $e->getMessage();
      $code    = $e->getCode() === 0 ? 500 : $e->getCode();

      $data = ['error' => $message];

      return new JsonResponse($data, $code);
    }
  }
}