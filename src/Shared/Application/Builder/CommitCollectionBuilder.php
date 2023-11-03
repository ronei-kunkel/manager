<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\Collection\CommitCollection;

final class CommitCollectionBuilder
{
  private array $data;

  public function __construct(
    private CommitBuilder $commitBuilder
  ) {
  }

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): CommitCollection
  {
    // $commits = $this->gitHubApiService->getCommits($this->data['before'], $this->data['after']);
    $commits = new CommitCollection(count($this->data));

    foreach ($this->data as $key => $commit) {

      $commit = $this->commitBuilder->setData($commit)->build();

      $commits->add($key, $commit);
    }

    return $commits;
  }
}