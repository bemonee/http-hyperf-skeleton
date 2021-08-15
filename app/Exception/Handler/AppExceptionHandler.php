<?php

declare(strict_types=1);

namespace App\Exception\Handler;

use Throwable;
use Hyperf\Config\Annotation\Value;
use App\Constants\Http\HttpStatusCodes;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Contract\StdoutLoggerInterface;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\ExceptionHandler\ExceptionHandler;

class AppExceptionHandler extends ExceptionHandler
{
    /** @Value("server_name") */
    private string $serverName;

    private StdoutLoggerInterface $logger;

    public function __construct(StdoutLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->logger->error(sprintf('%s[%s] in %s', $throwable->getMessage(), $throwable->getLine(), $throwable->getFile()));
        $this->logger->error($throwable->getTraceAsString());

        return $response
            ->withHeader('Server', $this->serverName)
            ->withStatus(HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR)
            ->withBody(new SwooleStream('Internal Server Error.'));
    }

    public function isValid(Throwable $throwable): bool
    {
        return true;
    }
}
