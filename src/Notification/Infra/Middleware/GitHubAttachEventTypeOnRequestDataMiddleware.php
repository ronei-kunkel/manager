<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Manager\Notification\Infra\Service\GitHubEventTypeService;

final class GitHubAttachEventTypeOnRequestDataMiddleware
{

  public function __construct(
    private GitHubEventTypeService $eventTypeVerification
  ) {
  }

  public function handle(Request $request, Closure $next)
  {
    try {

      $request->merge([
        'event_type' => $this->eventTypeVerification->getEventType($request)
      ]);

      return $next($request);

    } catch (\Throwable $th) {
      return new JsonResponse(['error' => $th->getMessage()], $th->getCode());
    }
  }
}
