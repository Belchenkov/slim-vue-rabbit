<?php

namespace Api\Http\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class BodyParamsMiddleware
{
    public function process(ServerRequestInterface $request, $handler): ResponseInterface
    {
        $contentType = $request->getHeaderLine('Content-Type');

        $parts = explode(';', $contentType);
        $mime = trim(array_shift($parts));

        if (preg_match('#[/+]json$#', $mime)) {
            $rawBody = $request->getBody()->getContents();
            $parsedBody = json_decode($rawBody, true);

            if (!empty($rawBody) && json_last_error()) {
                throw new \InvalidArgumentException('Error when parsing JSON request body: ' . json_last_error_msg());
            }

            $request = $request->withParsedBody($parsedBody);
        }

        return $handler->handle($request);
    }
}