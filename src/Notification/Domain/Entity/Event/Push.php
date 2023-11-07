<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Entity\Event;

use Manager\Notification\Domain\Entity\Repository;
use Manager\Notification\Domain\Entity\Sender;
use Manager\Notification\Domain\Type\CommitCollection;
use Manager\Notification\Domain\Type\Platform;
use Manager\Notification\Domain\Type\Reference;

final class Push
{
  private bool $deployable;

  public function __construct(
    private Reference $reference,
    private Platform $platform,
    private Repository $repository,
    private Sender $sender,
    private CommitCollection $commits,
  ) {
    $this->checkIfDeployable();
  }

  private function checkIfDeployable(): void
  {
    $lastCommit = $this->commits->getLast();

    $toDefaultBranch = ($this->reference->targetBranch() === $this->repository->defaultBranch());

    $this->deployable = ($lastCommit->isMerge() and $toDefaultBranch);
  }

  public function deployable(): bool
  {
    return $this->deployable;
  }

  public function reference(): Reference
  {
    return $this->reference;
  }

  public function platform(): Platform
  {
    return $this->platform;
  }

  public function repository(): Repository
  {
    return $this->repository;
  }

  public function sender(): Sender
  {
    return $this->sender;
  }

  public function commits(): CommitCollection
  {
    return $this->commits;
  }
}