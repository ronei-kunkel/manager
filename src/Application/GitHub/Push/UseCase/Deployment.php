<?php declare(strict_types=1);

namespace Manager\Application\GitHub\Push\UseCase;

use Manager\Application\Output;

final class Deployment
{
  public function __construct(
    // private DeploymentMySqlRepository $deploymentRepository,
  ) {
  }

  public function execute(): Output
  {
    return new Output(501);
  }
}