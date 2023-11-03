<?php declare(strict_types=1);

namespace Manager\Notification\Infra\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Manager\Notification\Infra\Service\GitHubSignatureVerificationService;

final class GitHubSignatureVerifyMiddleware
{

  public function __construct(
    private GitHubSignatureVerificationService $signatureVerification
  ) {
  }

  public function handle(Request $request, Closure $next)
  {

    if (!$this->signatureVerification->hasValidSignature($request)) {
      return new JsonResponse(['error' => 'Missing signature'], 403);
    }

    if (!$this->signatureVerification->verify($request)) {
      return new JsonResponse(['error' => 'Signature mismatch'], 401);
    }

    return $next($request);
  }
}
