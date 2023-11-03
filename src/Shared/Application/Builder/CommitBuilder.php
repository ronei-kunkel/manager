<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\Entity\Commit\Commit;

final class CommitBuilder
{
  private array $data;

  public function __construct(
    private AuthorBuilder $authorBuilder,
    private CommitterBuilder $committerBuilder
  ) {
  }

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Commit
  {
    $author    = $this->authorBuilder->setData($this->data['author'])->build();
    $committer = $this->committerBuilder->setData($this->data['committer'])->build();

    return new Commit(
      $this->data['id'],
      $this->data['message'],
      $author,
      $committer,
      $this->data['timestamp']
    );

  }
}