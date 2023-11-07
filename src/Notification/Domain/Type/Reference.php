<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Type;

final class Reference
{
  public function __construct(
    private string $targetBranch,
    private string $initialCommit,
    private string $finalCommit
  ) {
    $this->adjustTargetBranch();
  }

  public function adjustTargetBranch(): void
  {
    $this->targetBranch = explode('/', $this->targetBranch)[2];
  }

  public function targetBranch(): string
  {
    return $this->targetBranch;
  }

  public function initialCommit(): string
  {
    return $this->initialCommit;
  }

  public function finalCommit(): string
  {
    return $this->finalCommit;
  }
}
