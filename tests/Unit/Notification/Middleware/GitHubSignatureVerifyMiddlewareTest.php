<?php declare(strict_types=1);

use Manager\Notification\Infra\Middleware\GitHubSignatureVerifyMiddleware;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

test("Return 403 when not have signature on request header", function ()
{
  $middleware = resolve(GitHubSignatureVerifyMiddleware::class);

  $request = new Request();

  $return = $middleware->handle($request, function ($request) {
    return $request;
  });

  expect($return->getStatusCode())->toBe(403);
});

test("Return 401 when have signature on request header but is invalid", function ()
{
  $middleware = resolve(GitHubSignatureVerifyMiddleware::class);

  $request = new Request(server: ['HTTP_X-Hub-Signature-256' => 'sha256=352da302026fqw310b0c2f30005a4932ea91a33rt4ff7a93660f6y420157dc5e']);

  $return = $middleware->handle($request, function ($request) {
    return $request;
  });

  expect($return->getStatusCode())->toBe(401);
});

test("Validate signature", function ()
{
  $middleware = resolve(GitHubSignatureVerifyMiddleware::class);

  $content = webhookSentPayload();
  $hash = 'sha256=' . hash_hmac('sha256', $content, $_ENV['GITHUB_WEBHOOK_KEY']);

  $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

  $return = $middleware->handle($request, function ($request) {
    return $request;
  });

  expect($return)->toBe($request);
});

