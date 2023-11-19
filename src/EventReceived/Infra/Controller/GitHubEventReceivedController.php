<?php declare(strict_types=1);

namespace Manager\EventReceived\Infra\Controller;

use Hyperf\Coroutine\Coroutine;
use Manager\EventReceived\Application\EventReceivedInput;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\HttpServer\Contract\RequestInterface;
use Manager\EventReceived\Application\EventReceivedHandler;

final class GitHubEventReceivedController
{

  public function __construct(
    private RequestInterface $request,
    private HttpResponse $response,
    private EventReceivedHandler $eventReceivedHandler
  ) {
  }

  public function __invoke(): ResponseInterface
  {
    $header = $this->request->getHeaders();
    $body = $this->request->getParsedBody();

    $eventReceivedInput = new EventReceivedInput($header, $body);

    Coroutine::create(function() use($eventReceivedInput) {
      $this->eventReceivedHandler->handle($eventReceivedInput);
    });

    return $this->response->json(['message' => 'Event Received'])->withStatus(202);
  }
}
