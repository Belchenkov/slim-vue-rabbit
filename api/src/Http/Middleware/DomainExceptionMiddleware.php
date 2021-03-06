<?php

declare(strict_types=1);

namespace Api\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class DomainExceptionMiddleware
{
    public function process(ServerRequestInterface $request, $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (\DomainException $e) {
            return new JsonResponse([
                'error' => $e->getMessage(),
            ], 400);
        }
    }
}