<?php declare(strict_types=1);

test('Process GitHub Push notification received', function ()
{
  $content = json_encode(json_decode(gitHubPushEventDeployableWebhookSentPayload(), true));
  $hash = 'sha256=' . hash_hmac('sha256', $content, $_ENV['GITHUB_WEBHOOK_KEY']);
  $headers = [
    'X-Hub-Signature-256' => $hash,
    'X-GitHub-Event'      => 'push'
  ];

  $response = $this->postJson($_ENV['BASE_URL'].'/api/github/push', json_decode(gitHubPushEventDeployableWebhookSentPayload(), true), $headers);

  expect($response->getStatusCode())->toBe(200)->and($response->getContent())->toBe('{"message":"Not implemented yet"}');
});
