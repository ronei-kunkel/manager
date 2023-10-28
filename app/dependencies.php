<?php

declare(strict_types=1);

use App\Settings\SettingsInterface;
use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Manager\Infra\Controller\GitHub\GithubPushEventController;
use Manager\Application\GitHub\Push\UseCase\Deployment;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        GithubPushEventController::class => function (ContainerInterface $c) {
            return new GithubPushEventController($c->get(Deployment::class));
        },
        Deployment::class => function (ContainerInterface $c) {
            return new Deployment();
        }
    ]);
};
