<?php

declare(strict_types=1);

namespace Api\Http\Middleware;

use Api\Http\ValidationException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class ValidationExceptionMiddleware
{
    public function process(ServerRequestInterface $request, $handler): ResponseInterface
    {
        try {
            return $handler->handle($request);
        } catch (ValidationException $e) {
            return new JsonResponse([
                'errors' => $e->getErrors()->toArray(),
            ], 400);
        }
    }
}