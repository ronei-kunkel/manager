<?php declare(strict_types=1);

namespace Manager\Application;

final readonly class Output
{
  public function __construct(
    public int $code,
    public mixed $message = null
  ) {
  }
}