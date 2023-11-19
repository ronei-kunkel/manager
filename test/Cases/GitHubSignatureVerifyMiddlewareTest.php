<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace HyperfTest\Cases;

use Hyperf\Testing\TestCase;
use HyperfTest\FunctionsTrait;
use function Hyperf\Support\env;

/**
 * @internal
 * @coversNothing
 */
class GitHubSignatureVerifyMiddlewareTest extends TestCase
{

    use FunctionsTrait;

    public function test_forbidden_when_send_request_without_signature()
    {
        $response = $this->post('/github/webhook');
        $response->assertForbidden()->assertJson(['error' => 'Missing signature']);
    }

    public function test_unauthorized_when_send_request_with_wrong_signature()
    {
        $data = json_decode($this->githubExamplePayload(), true);

        $jsonData = json_encode($data);

        $hash    = 'sha256=' . hash_hmac('sha256', $jsonData, env('GITHUB_WEBHOOK_KEY'));

        $response = $this->post('/github/webhook', $data, ['X-Hub-Signature-256' => $hash]);

        $response->assertUnauthorized()->assertJson(['error' => 'Signature mismatch']);
    }
}
