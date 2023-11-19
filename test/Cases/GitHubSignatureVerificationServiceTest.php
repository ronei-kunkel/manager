<?php declare(strict_types=1);

namespace HyperfTest\Cases;

use Hyperf\HttpMessage\Server\Request;
use Hyperf\HttpMessage\Uri\Uri;
use Hyperf\Testing\TestCase;
use HyperfTest\FunctionsTrait;
use Manager\EventReceived\Infra\Service\GitHubSignatureVerificationService;
use function Hyperf\Support\env;

class GitHubSignatureVerificationServiceTest extends TestCase
{

  use FunctionsTrait;

  public function test_return_true_when_have_signature_in_sha256_to_validate()
  {
    $content = $this->githubExamplePayload();
    $hash    = 'sha256=' . hash_hmac('sha256', $content, env('GITHUB_WEBHOOK_KEY'));

    $request = new Request('POST', new Uri('http://www.base-uri.com/teste'), ['X-Hub-Signature-256' => $hash], $content);

    $service = new GitHubSignatureVerificationService();

    $this->assertTrue($service->hasValidSignature($request));
  }
}

// test("Return false when not have signature", function ()
// {
//   $content = githubExamplePayload();
//   $request = new Request(content: $content);

//   $service = new GitHubSignatureVerificationService();

//   expect($service->hasValidSignature($request))->toBeFalse();
// });

// test("Return false when have signature to validate but is not sha256", function ()
// {
//   $content = githubExamplePayload();
//   $hash = 'sha1=' . hash_hmac('sha1', $content, env('GITHUB_WEBHOOK_KEY'));

//   $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

//   $service = new GitHubSignatureVerificationService();

//   expect($service->hasValidSignature($request))->toBeFalse();
// });

// test("Return true when have signatured sha256", function ()
// {
//   $content = githubExamplePayload();
//   $hash = 'sha256=' . hash_hmac('sha256', $content, env('GITHUB_WEBHOOK_KEY'));

//   $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

//   $service = new GitHubSignatureVerificationService();

//   expect($service->verify($request))->toBeTrue();
// });

// test("Return false when have invalid signature sha256", function ()
// {
//   $content = githubExamplePayload();
//   $hash = 'sha256=' . hash_hmac('sha256', $content, 'invalid_secret');

//   $request = new Request(server: ['HTTP_X-Hub-Signature-256' => $hash], content: $content);

//   $service = new GitHubSignatureVerificationService();

//   expect($service->verify($request))->toBeFalse();
// });