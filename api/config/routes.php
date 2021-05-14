<?php

declare(strict_types=1);

use Api\Http\Action\Auth\SignUp\ConfirmAction;
use Api\Http\Action\Auth\SignUp\RequestAction;
use Api\Http\Action\HomeAction;
use League\OAuth2\Server\Middleware\ResourceServerMiddleware;
use Slim\App;
use Api\Http\Middleware;
use Api\Infrastructure\Framework\Middleware\CallableMiddlewareAdapter as CM;
use Psr\Container\ContainerInterface;

return function (App $app, ContainerInterface $container) {
    $app->add(new CM($container, Middleware\BodyParamsMiddleware::class));
    $app->add(new CM($container, Middleware\DomainExceptionMiddleware::class));
    $app->add(new CM($container, Middleware\ValidationExceptionMiddleware::class));

    $auth = $container->get(ResourceServerMiddleware::class);

    $app->get('/', HomeAction::class . ':handle');
    $app->post('/auth/signup', RequestAction::class . ':handle');
    $app->post('/auth/signup/confirm', ConfirmAction::class . ':handle');

    $app->post('/oauth/auth', Action\Auth\OAuthAction::class . ':handle');

    $app->group('/profile', function () {
        $this->get('', Action\Profile\ShowAction::class . ':handle');
    })->add($auth);

    $app->group('/author', function () {
        $this->get('', Action\Author\ShowAction::class . ':handle');
    })->add($auth);
};