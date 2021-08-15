<?php

namespace App\Exception\Handler;

use Throwable;
use Hyperf\Config\Annotation\Value;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;

final class JsonHttpExceptionHandler extends HttpExceptionHandler
{
    /** @Value("server_name") */
    private string $serverName;

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if (! $response->hasHeader('content-type')) {
            $response = $response->withAddedHeader('content-type', 'application/json; charset=utf-8');
        }

        $response = $response->withHeader('Server', $this->serverName);

        return parent::handle($throwable, $response);
    }
}
