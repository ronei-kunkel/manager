<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Service;

use Illuminate\Http\Request;

final class GitHubEventTypeService
{
  private const HEADER = 'X-GitHub-Event';

  public function getEventType(Request $request): string
  {
    $this->verifyHeader($request);

    return $request->header(self::HEADER);
  }

  private function verifyHeader(Request $request): void
  {
    $eventType = $request->header(self::HEADER);

    if(empty($eventType)) {
      throw new \Exception('Request has no event type header', 400);
    }
  }
}
