<?php declare(strict_types=1);

namespace Manager\Shared\Domain\Collection;

abstract class Collection
{
  abstract public function add(object $commit): void;
  abstract public function getIterator(): \ArrayIterator;
  abstract public function count(): int;
}