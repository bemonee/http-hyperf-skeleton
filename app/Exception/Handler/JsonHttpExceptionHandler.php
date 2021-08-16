<?php

namespace App\Exception\Handler;

use Throwable;
use Hyperf\Contract\ConfigInterface;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\ExceptionHandler\Formatter\FormatterInterface;
use Hyperf\HttpServer\Exception\Handler\HttpExceptionHandler;

final class JsonHttpExceptionHandler extends HttpExceptionHandler
{
    private ConfigInterface $config;

    public function __construct(
        ConfigInterface $config,
        StdoutLoggerInterface $logger,
        FormatterInterface $formatter
    ) {
        $this->config = $config;

        parent::__construct($logger, $formatter);
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        if (! $response->hasHeader('content-type')) {
            $response = $response->withAddedHeader('content-type', 'application/json; charset=utf-8');
        }

        $response = $response->withHeader('Server', $this->config->get('server_name'));

        return parent::handle($throwable, $response);
    }
}
