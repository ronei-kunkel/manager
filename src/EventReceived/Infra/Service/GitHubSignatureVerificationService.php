<?php declare(strict_types=1);

namespace Manager\EventReceived\Infra\Service;

use Psr\Http\Message\ServerRequestInterface;
use function Hyperf\Support\env;

final class GitHubSignatureVerificationService
{
  private const HEADER = 'X-Hub-Signature-256';
  private const ALGO = 'sha256';
  private const PREFIX = self::ALGO.'=';
  private string $secret;

  public function __construct() {
    $this->secret = env('GITHUB_WEBHOOK_KEY');
  }

  public function hasValidSignature(ServerRequestInterface $request): bool
  {
    $signature = $request->getHeaderLine(self::HEADER);

    if($signature) {
      return str_contains($signature, self::PREFIX);
    }

    return false;
  }

  public function verify(ServerRequestInterface $request): bool
  {
    $dataHashed = self::PREFIX . hash_hmac(self::ALGO, $request->getBody()->getContents(), $this->secret);

    return hash_equals($dataHashed, $request->getHeaderLine(self::HEADER));
  }
}
