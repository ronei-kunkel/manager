<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Hyperf\HttpServer\Router\Router;
use Manager\EventReceived\Infra\Controller\GitHubEventReceivedController;
use Manager\EventReceived\Infra\Middleware\GitHubSignatureVerifyMiddleware;

// for github 
Router::addGroup('/github', function() {

  // notification about events
  Router::post(
    '/webhook[/]',
    GitHubEventReceivedController::class,
  );

},
[
  'middleware' => [
    GitHubSignatureVerifyMiddleware::class
  ]
]);

// for gitlab