<?php declare(strict_types=1);

namespace App\Infra\Controller\Github;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

final class PushNotifiedController
{
  public function __construct(
    private ContainerInterface $container,
  ) {
  }

  public function __invoke(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $response->getBody()->write(json_encode($request->getParsedBody()));
    return $response->withHeader('Content-Type', 'application/json')->withStatus(200);
  }
}