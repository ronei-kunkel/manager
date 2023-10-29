<?php declare(strict_types=1);

namespace Manager\Shared\Application\UseCase;

final readonly class Output
{
  public function __construct(
    public int $code,
    public ?string $message = null
  ) {
  }
}