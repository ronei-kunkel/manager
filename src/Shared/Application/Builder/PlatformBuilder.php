<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\ValueObject\Platform;

final class PlatformBuilder
{
  private Platform $platform;

  public function gitHub(): self
  {
    $this->platform = new Platform('github', 'GitHub', 'https://github.com');
    return $this;
  }

  public function build(): Platform
  {
    return $this->platform;
  }
}