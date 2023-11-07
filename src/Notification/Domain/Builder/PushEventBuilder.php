<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Builder;

use Manager\Notification\Domain\Entity\Event\Push;
use Manager\Notification\Domain\Entity\Repository;
use Manager\Notification\Domain\Entity\Sender;
use Manager\Notification\Domain\Type\CommitCollection;
use Manager\Notification\Domain\Type\Platform;
use Manager\Notification\Domain\Type\Reference;

final class PushEventBuilder
{
  private Platform $platform;

  private Reference $reference;

  private Repository $repository;

  private Sender $sender;

  private CommitCollection $commits;

  private bool $deployable;

  public function fromPlatform(Platform $platform): self
  {
    $this->platform = $platform;
    return $this;
  }

  public function withReference(Reference $reference): self
  {
    $this->reference = $reference;
    return $this;
  }

  public function withRepository(Repository $repository): self
  {
    $this->repository = $repository;
    return $this;
  }

  public function withSender(Sender $sender): self
  {
    $this->sender = $sender;
    return $this;
  }

  public function withCommits(CommitCollection $commits): self
  {
    $this->commits = $commits;
    return $this;
  }

  public function build(): Push
  {
    return new Push(
      $this->reference,
      $this->platform,
      $this->repository,
      $this->sender,
      $this->commits
    );
  }
}