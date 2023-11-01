<?php declare(strict_types=1);

use Manager\Notification\Infra\Service\SignatureVerificationService;
use Illuminate\Http\Request;

test("Return true when have signature in sha256 to validate", function ()
{
  $content = webhookSentPayload();
  $hash = 'sha256=' . hash_hmac('sha256', $content, $_ENV['GITHUB_WEBHOOK_KEY']);

  $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

  $service = new SignatureVerificationService();

  expect($service->hasValidSignature($request))->toBeTrue();
});

test("Return false when not have signature", function ()
{
  $content = webhookSentPayload();
  $request = new Request(content: $content);

  $service = new SignatureVerificationService();

  expect($service->hasValidSignature($request))->toBeFalse();
});

test("Return false when have signature to validate but is not sha256", function ()
{
  $content = webhookSentPayload();
  $hash = 'sha1=' . hash_hmac('sha1', $content, $_ENV['GITHUB_WEBHOOK_KEY']);

  $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

  $service = new SignatureVerificationService();

  expect($service->hasValidSignature($request))->toBeFalse();
});

test("Return true when have signatured sha256", function ()
{
  $content = webhookSentPayload();
  $hash = 'sha256=' . hash_hmac('sha256', $content, $_ENV['GITHUB_WEBHOOK_KEY']);

  $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

  $service = new SignatureVerificationService();

  expect($service->verify($request))->toBeTrue();
});

test("Return false when have invalid signature sha256", function ()
{
  $content = webhookSentPayload();
  $hash = 'sha256=' . hash_hmac('sha256', $content, 'invalid_secret');

  $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

  $service = new SignatureVerificationService();

  expect($service->verify($request))->toBeFalse();
});