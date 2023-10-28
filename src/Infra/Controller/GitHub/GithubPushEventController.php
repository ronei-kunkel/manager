<?php declare(strict_types=1);

namespace Manager\Infra\Controller\GitHub;

use Manager\Application\GitHub\Push\UseCase\Deployment;
use Manager\Infra\Controller\Controller;
use Psr\Http\Message\ResponseInterface;

final class GithubPushEventController extends Controller
{

  protected function hasResource(): bool
  {
    return false;
  }

  public function __construct(
    private Deployment $deployment
  ) {
  }

  protected function handle(): ResponseInterface
  {
    try {
      $output = $this->deployment->execute();

      return $this->jsonResponse($output->code);
    } catch (\Exception $e) {
      $message = [
        'error' => $e->getMessage(),
      ];
      return $this->jsonResponse($e->getCode(), $message);
    }
  }
}