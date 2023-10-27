<?php declare(strict_types=1);

namespace Manager\Domain\Entity\Platform;

abstract class Platform
{
  abstract public function hash(): string;

  abstract public function name(): string;

  abstract public function url(): string;
}