<?php declare(strict_types=1);

namespace Manager\ProcessEvent\Infra\Service;

use function Hyperf\Support\make;

final class ClassInstantiatorService
{
  public function instantiate(string $className): mixed
  {
    return make($className);
  }
}