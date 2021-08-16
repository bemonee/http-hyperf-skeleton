<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Handler;

use Carbon\Carbon;
use Swoole\Exception;
use Hyperf\Utils\MessageBag;
use PHPUnit\Framework\TestCase;
use Hyperf\Validation\Validator;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;
use Hyperf\HttpMessage\Server\Response;
use Hyperf\Validation\ValidationException;
use App\Exception\Handler\HttpValidationExceptionHandler;

final class HttpValidationExceptionHandlerTest extends TestCase
{
    private const EXPECTED_VALIDATION_ERRORS = [
        'property1' => 'invalid property1',
        'property2' => 'invalid property2'
    ];

    private ConfigInterface $config;

    private HttpValidationExceptionHandler $httpValidationExceptionHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->config = ApplicationContext::getContainer()->get(ConfigInterface::class);

        $this->httpValidationExceptionHandler = new HttpValidationExceptionHandler($this->config);
    }

    public function testIsValid()
    {
        $this->assertNotTrue(
            $this->httpValidationExceptionHandler->isValid((new Exception()))
        );

        $this->assertTrue(
            $this->httpValidationExceptionHandler->isValid($this->getMockedValidationException())
        );
    }

    public function testHandle()
    {
        Carbon::setTestNow(Carbon::now());

        $validationException = $this->getMockedValidationException();

        $serverResponse = $this->httpValidationExceptionHandler->handle(
            $validationException,
            (new Response())
        );

        $this->assertEquals(
            $this->config->get('server_name'),
            $serverResponse->getHeaderLine('Server')
        );

        $this->assertEquals(
            HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY,
            $serverResponse->getStatusCode()
        );

        $expectedPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY,
            self::EXPECTED_VALIDATION_ERRORS
        );

        $actualPayload = $serverResponse->getBody();

        $this->assertEquals($expectedPayload, $actualPayload);
    }

    private function getMockedValidationException(): ValidationException
    {
        $validator = $this->createMock(Validator::class);

        $messageBag = new MessageBag(self::EXPECTED_VALIDATION_ERRORS);

        $validator->method('errors')->willReturn($messageBag);

        return new ValidationException($validator);
    }
}
