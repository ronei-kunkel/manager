<?php declare(strict_types=1);

namespace Manager\Shared\Domain\ValueObject;

final class Platform
{
  public function __construct(
    private string $hash,
    private string $name,
    private string $url
  ) {
  }

  public function hash(): string
  {
    return $this->hash;
  }

  public function name(): string
  {
    return $this->name;
  }

  public function url(): string
  {
    return $this->url;
  }
}