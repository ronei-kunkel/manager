<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\ValueObject\Merger;

final class MergerBuilder
{
  private array $data;

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Merger
  {
    return new Merger(
      $this->data['name'],
      $this->data['email'],
      $this->data['username'],
    );
  }
}