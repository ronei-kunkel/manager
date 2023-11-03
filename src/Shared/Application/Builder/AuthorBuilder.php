<?php declare(strict_types=1);

namespace Manager\Shared\Application\Builder;

use Manager\Shared\Domain\Entity\Commit\Author;

final class AuthorBuilder
{
  private array $data;

  public function setData(array $data): self
  {
    $this->data = $data;
    return $this;
  }

  public function build(): Author
  {
    return new Author(
      null,
      $this->data['username'],
      $this->data['email']
    );
  }
}