<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Http;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;
use App\Exception\Http\ForbiddenHttpException;

final class ForbiddenHttpExceptionTest extends TestCase
{
    private const EXPECTED_MESSAGE = 'User is not authorized to perform this action';

    public function testConstructor(): void
    {
        Carbon::setTestNow(Carbon::now());

        $exception = new ForbiddenHttpException();

        $this->assertEquals(
            HttpStatusCodes::HTTP_FORBIDDEN,
            $exception->getStatusCode()
        );

        $expectedPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_FORBIDDEN,
            self::EXPECTED_MESSAGE
        );

        $this->assertEquals($expectedPayload, $exception->getMessage());
    }
}
