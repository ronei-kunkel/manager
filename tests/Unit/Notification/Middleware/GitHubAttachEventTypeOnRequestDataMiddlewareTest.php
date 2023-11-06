<?php declare(strict_types=1);

use Manager\Notification\Infra\Middleware\GitHubAttachEventTypeOnRequestDataMiddleware;
use Illuminate\Http\Request;

test("Event type attached on request", function ()
{
  $middleware = resolve(GitHubAttachEventTypeOnRequestDataMiddleware::class);

  $content = gitHubPushEventDeployableWebhookSentPayload();

  $request = new Request(server: ['HTTP_X-GitHub-Event' => 'event'], content: $content);

  $request = $middleware->handle($request, function ($request) {
    return $request;
  });

  expect($request)->toHaveKey('event_type', 'event');
});

test("Return 400 if missing event type header", function ()
{
  $middleware = resolve(GitHubAttachEventTypeOnRequestDataMiddleware::class);

  $content = gitHubPushEventDeployableWebhookSentPayload();

  $request = new Request(content: $content);

  $response = $middleware->handle($request, function ($request) {
    return $request;
  });

  expect($response->getStatusCode())->toBe(400);
});

