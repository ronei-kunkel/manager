<?php declare(strict_types=1);

use Illuminate\Http\Request;
use Manager\Notification\Infra\Service\GitHubEventTypeService;

test("Throw exception when not have event type header", function ()
{
  $content = gitHubPushEventDeployableWebhookSentPayload();
  $request = new Request(content: $content);

  $service = new GitHubEventTypeService();

  $service->getEventType($request);
})->throws(\Exception::class, 'Request has no event type header', 400);

test("Return event type", function ()
{
  $content = gitHubPushEventDeployableWebhookSentPayload();
  $request = new Request(server: ['HTTP_X-GitHub-Event' => 'event'], content: $content);

  $service = new GitHubEventTypeService();

  $eventType = $service->getEventType($request);

  expect($eventType)->toBe('event');
});