<?php declare(strict_types=1);

test('Process notification with success', function ()
{
  $content = json_encode(json_decode(webhookSentPayload(), true));
  $hash = 'sha256=' . hash_hmac('sha256', $content, $_ENV['GITHUB_WEBHOOK_KEY']);
  $headers = ['X-Hub-Signature-256' => $hash];

  $response = $this->postJson($_ENV['TEST_SELF_URL'].'/api/github/push', json_decode(webhookSentPayload(), true), $headers);

  expect($response->getStatusCode())->toBe(200)->and($response->getContent())->toBeNull();
});
