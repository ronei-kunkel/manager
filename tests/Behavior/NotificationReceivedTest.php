<?php declare(strict_types=1);

test('Process GitHub notification received', function ()
{
  $content = json_encode(json_decode(webhookSentPayload(), true));
  $hash = 'sha256=' . hash_hmac('sha256', $content, $_ENV['GITHUB_WEBHOOK_KEY']);
  $headers = [
    'X-Hub-Signature-256' => $hash,
    'X-GitHub-Event'      => 'push'
  ];

  $response = $this->postJson($_ENV['BASE_URL'].'/api/github/notify', json_decode(webhookSentPayload(), true), $headers);

  expect($response->getStatusCode())->toBe(501)->and($response->getContent())->toBe('{"message":"Not implemented yet"}');
});
