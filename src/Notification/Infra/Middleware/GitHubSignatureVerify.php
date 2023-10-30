<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Manager\Notification\Infra\Service\SignatureVerificationService;

final class GitHubSignatureVerify
{

  public function __construct(
    private SignatureVerificationService $signatureVerification
  ) {
  }

  public function handle(Request $request, Closure $next): JsonResponse
  {
    $signature = $request->hasHeader('x-hub-signature-256') ? $request->header('x-hub-signature-256') : null;

    if (!$signature) {
      return new JsonResponse(['error' => 'Missing signature'], 403);
    }

    if (!$this->signatureVerification->verify($request->getContent(), $signature)) {
      return new JsonResponse(['error' => 'Signature mismatch'], 401);
    }

    return $next($request);
  }
}
