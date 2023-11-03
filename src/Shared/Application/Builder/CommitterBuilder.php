<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\Entity\Commit\Committer;

final class CommitterBuilder
{
  private array $data;

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Committer
  {
    return new Committer(
      null,
      $this->data['username'],
      $this->data['email']
    );
  }
}