<?php

declare(strict_types=1);

use Slim\App;
use Slim\Interfaces\RouteCollectorProxyInterface;
use Manager\Infra\Controller\GitHub\PushNotifiedController;

return function (App $app) {
    $app->group('/api', function (RouteCollectorProxyInterface $group) {
        $group->group('/github', function (RouteCollectorProxyInterface $group) {
            $group->post('/push', PushNotifiedController::class);
            // $group->post('/other', OtherNotifiedController::class);
            // $group->post('/another', AnotherNotifiedController::class);
        });
        $group->group('/gitlab', function (RouteCollectorProxyInterface $group) {
            // $group->post('/other', OtherNotifiedController::class);
            // $group->post('/another', AnotherNotifiedController::class);
        });
    });
};
