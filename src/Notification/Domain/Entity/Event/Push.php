<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Entity\Event;

use Manager\Shared\Domain\Contract\Event;
use Manager\Shared\Domain\Collection\CommitCollection;
use Manager\Shared\Domain\Entity\Repository\Repository;
use Manager\Shared\Domain\ValueObject\Merger;
use Manager\Shared\Domain\ValueObject\Platform;

final class Push implements Event
{
  private const HASH = 'push';

  private bool $isMerge = false;

  public function __construct(
    private ?int $id,
    private Platform $platform,
    private Repository $repository,
    private ?Merger $merger,
    private CommitCollection $commits,
    private string $targetBranchReference
  ) {
    $this->checkIsMerge();
  }

  public function id(): ?int
  {
    return $this->id;
  }

  public function hash(): string
  {
    return self::HASH;
  }

  public function platform(): Platform
  {
    return $this->platform;
  }

  public function commits(): CommitCollection
  {
    return $this->commits;
  }

  public function repository(): Repository
  {
    return $this->repository;
  }

  private function checkIsMerge(): void
  {
    $ref = explode('/', $this->targetBranchReference)[2];

    $pushToDefaultBranch = ($ref === $this->repository->defaultBranch());

    $lastCommit = $this->commits->getLast();

    $fromMergedPullRequest = ($lastCommit->commiter()->nickName() === 'web-flow');

    if($pushToDefaultBranch and $fromMergedPullRequest) {
      $this->isMerge = true;
    }
  }
}