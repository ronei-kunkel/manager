<?php declare(strict_types=1);

namespace Manager\EventReceived\Infra\Middleware;

use Manager\EventReceived\Infra\Service\GitHubSignatureVerificationService;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Hyperf\HttpServer\Contract\RequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final class GitHubSignatureVerifyMiddleware implements MiddlewareInterface
{

  public function __construct(
    protected HttpResponse $response,
    protected RequestInterface $request,
    private GitHubSignatureVerificationService $signatureVerification
  ) {
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    if (!$this->signatureVerification->hasValidSignature($request)) {
      return $this->response->json(['error' => 'Missing signature'])->withStatus(403);
    }

    if (!$this->signatureVerification->verify($request)) {
      return $this->response->json(['error' => 'Signature mismatch'])->withStatus(401);
    }

    return $handler->handle($request);
  }
}
