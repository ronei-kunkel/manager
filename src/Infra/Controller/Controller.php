<?php declare(strict_types=1);

namespace Manager\Infra\Controller;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

abstract class Controller
{
  protected ?string $resource;

  protected ServerRequestInterface $request;

  protected ResponseInterface $response;

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $this->request  = $request;
    $this->response = $response;
    $this->resource = $this->hasResource() ? array_shift($args) : null;
    return $this->handle();
  }

  abstract protected function hasResource(): bool;

  abstract protected function handle(): ResponseInterface;

  protected function jsonResponse(int $code, ?array $message = null): ResponseInterface
  {
    if ($message) {
      $this->response->getBody()->write(json_encode($message));
    }

    return $this->response->withHeader('Content-Type', 'application/json')->withStatus($code ?? 500);
  }
}