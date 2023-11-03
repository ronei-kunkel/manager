<?php declare(strict_types=1);
use Manager\Shared\Application\Builder\PlatformBuilder;

test("Build github platform", function ()
{
  $builder = new PlatformBuilder();

  $github = $builder->gitHub()->build();

  expect($github->name())->toBe('GitHub');
  expect($github->hash())->toBe('github');
  expect($github->url())->toBe('https://github.com');

});