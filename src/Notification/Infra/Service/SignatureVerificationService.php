<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Service;

final class SignatureVerificationService
{
  public function verify(string $data, string $signature): bool
  {
    $dataHashed = 'sha256=' . hash_hmac('sha256', $data, $_ENV['GITHUB_WEBHOOK_KEY']);

    return hash_equals($dataHashed, $signature);
  }
}
