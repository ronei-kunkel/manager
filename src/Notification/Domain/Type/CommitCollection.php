<?php declare(strict_types=1);

namespace Manager\Notification\Domain\Type;

use Manager\Notification\Domain\Entity\Commit;

final class CommitCollection implements \IteratorAggregate, \Countable
{

  private \SplFixedArray $commits;

  public function __construct(
    int $quantity
  ) {
    $this->commits = new \SplFixedArray($quantity);
  }

  public function add(int $index, Commit $commit): void
  {
    $this->commits->offsetSet($index, $commit);
  }

  public function getIterator(): \ArrayIterator
  {
    return new \ArrayIterator($this->commits);
  }

  public function count(): int
  {
    return $this->commits->count();
  }

  public function getLast(): Commit
  {
    return $this->commits->offsetGet($this->count() - 1);
  }
}