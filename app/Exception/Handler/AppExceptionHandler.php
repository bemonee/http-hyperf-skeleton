<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use Throwable;
use Hyperf\Contract\ConfigInterface;
use App\Constants\Http\HttpStatusCodes;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\ExceptionHandler\ExceptionHandler;

class AppExceptionHandler extends ExceptionHandler
{
    private ConfigInterface $config;

    private StdoutLoggerInterface $logger;

    public function __construct(ConfigInterface $config, StdoutLoggerInterface $logger)
    {
        $this->config = $config;
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());

        $payload = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR);

        return $response
            ->withHeader('Server', $this->config->get('server_name'))
            ->withStatus(HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR)
            ->withBody(new SwooleStream($payload));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
