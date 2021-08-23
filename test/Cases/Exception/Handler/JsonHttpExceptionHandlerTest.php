<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Handler;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;
use Hyperf\HttpMessage\Server\Response;
use Hyperf\Contract\StdoutLoggerInterface;
use App\Exception\Http\ForbiddenHttpException;
use App\Exception\Handler\JsonHttpExceptionHandler;

use Hyperf\ExceptionHandler\Formatter\FormatterInterface;

final class JsonHttpExceptionHandlerTest extends TestCase
{
    private const EXPECTED_MESSAGE = 'User is not authorized to perform this action';

    private ConfigInterface $config;

    private JsonHttpExceptionHandler $jsonHttpExceptionHandler;

    protected function setUp(): void
    {
        parent::setUp();

        /** @var StdoutLoggerInterface $mockedLogger */
        $mockedLogger = $this->createMock(StdoutLoggerInterface::class);

        /** @var FormatterInterface $mockedFormatter */
        $mockedFormatter = $this->createMock(FormatterInterface::class);

        $this->config = ApplicationContext::getContainer()->get(ConfigInterface::class);

        $this->jsonHttpExceptionHandler = new JsonHttpExceptionHandler(
            $this->config,
            $mockedLogger,
            $mockedFormatter
        );
    }

    public function testHandle(): void
    {
        Carbon::setTestNow(Carbon::now());

        $serverResponse = $this->jsonHttpExceptionHandler->handle(
            (new ForbiddenHttpException()),
            (new Response())
        );

        $this->assertEquals(
            $this->config->get('server_name'),
            $serverResponse->getHeaderLine('Server')
        );

        $this->assertEquals(
            HttpStatusCodes::HTTP_FORBIDDEN,
            $serverResponse->getStatusCode()
        );

        $expectedPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_FORBIDDEN,
            self::EXPECTED_MESSAGE
        );

        $actualPayload = $serverResponse->getBody();

        $this->assertEquals($expectedPayload, $actualPayload);
    }
}
