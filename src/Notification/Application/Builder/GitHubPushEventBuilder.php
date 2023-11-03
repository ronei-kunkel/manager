<?php declare(strict_types=1);

namespace Manager\Notification\Application\Builder;

use Manager\Notification\Domain\Entity\Event\Push;
use Manager\Shared\Application\Builder\CommitCollectionBuilder;
use Manager\Shared\Application\Builder\PlatformBuilder;
use Manager\Shared\Application\Builder\RepositoryBuilder;
use Manager\Shared\Application\Builder\MergerBuilder;
use Manager\Shared\Domain\ValueObject\Platform;

final class GitHubPushEventBuilder
{
  private Push $push;

  private array $data;

  private Platform $platform;

  private bool $mergeEvent = false;

  public function __construct(
    private PlatformBuilder $platformBuilder,
    private RepositoryBuilder $repositoryBuilder,
    private MergerBuilder $mergerBuilder,
    private CommitCollectionBuilder $commitCollectionBuilder,
  ) {
    $this->platform = $this->platformBuilder->gitHub()->build();
  }

  public function withData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Push
  {
    $repository = $this->repositoryBuilder->setPlatform($this->platform)->setData($this->data['repository'])->build();
    $merger     = $this->mergerBuilder->setData($this->data['head_commit']['committer'])->build();
    $commits    = $this->commitCollectionBuilder->setData($this->data['commits'])->build();

    $this->push = new Push(
      null,
      $this->platform,
      $repository,
      $merger,
      $commits,
      $this->data['ref']
    );
    return $this->push;
  }
}