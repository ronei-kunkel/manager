<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Service;

use Illuminate\Http\Request;

final class SignatureVerificationService
{
  private const HEADER = 'X-Hub-Signature-256';
  private const ALGO = 'sha256';
  private const PREFIX = self::ALGO.'=';
  private string $secret;

  public function __construct()
  {
    $this->secret = $_ENV['GITHUB_WEBHOOK_KEY'];
  }

  public function hasValidSignature(Request $request): bool
  {
    $signature = $request->header(self::HEADER);

    if($signature) {
      return str_contains($signature, self::PREFIX);
    }

    return false;
  }

  public function verify(Request $request): bool
  {
    $dataHashed = self::PREFIX . hash_hmac(self::ALGO, $request->getContent(), $this->secret);

    return hash_equals($dataHashed, $request->header(self::HEADER));
  }
}
