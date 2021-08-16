<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Handler;

use Carbon\Carbon;
use Swoole\Exception;
use PHPUnit\Framework\TestCase;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use App\Constants\Http\HttpStatusCodes;
use Hyperf\HttpMessage\Server\Response;
use Hyperf\Contract\StdoutLoggerInterface;
use App\Exception\Handler\AppExceptionHandler;

final class AppExceptionHandlerTest extends TestCase
{
    private ConfigInterface $config;

    private AppExceptionHandler $appExceptionHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = ApplicationContext::getContainer()->get(ConfigInterface::class);

        $mockedLogger = $this->createMock(StdoutLoggerInterface::class);

        $this->appExceptionHandler = new AppExceptionHandler($this->config, $mockedLogger);
    }

    public function testIsValid()
    {
        $this->assertTrue(
            $this->appExceptionHandler->isValid((new Exception()))
        );
    }

    public function testHandle()
    {
        Carbon::setTestNow(Carbon::now());

        $serverResponse = $this->appExceptionHandler->handle(
            (new Exception()),
            (new Response())
        );

        $this->assertEquals(
            $this->config->get('server_name'),
            $serverResponse->getHeaderLine('Server')
        );

        $this->assertEquals(
            HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR,
            $serverResponse->getStatusCode()
        );

        $expectedPayload = HttpStatusCodes::getMessageForCode(
            HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR
        );

        $this->assertEquals($expectedPayload, $serverResponse->getBody());
    }
}
