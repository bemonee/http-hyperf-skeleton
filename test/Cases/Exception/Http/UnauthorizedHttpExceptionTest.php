<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Http;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;
use App\Exception\Http\UnauthorizedHttpException;

final class UnauthorizedHttpExceptionTest extends TestCase
{
    private const A_DUMMY_REASON = 'A dummy reason';

    private const EXPECTED_MESSAGE = 'User must be authenticated to perform this action - Reason: '.self::A_DUMMY_REASON;

    public function testConstructor(): void
    {
        Carbon::setTestNow(Carbon::now());

        $exception = new UnauthorizedHttpException(self::A_DUMMY_REASON);

        $this->assertEquals(
            HttpStatusCodes::HTTP_UNAUTHORIZED,
            $exception->getStatusCode()
        );

        $expectedPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_UNAUTHORIZED,
            self::EXPECTED_MESSAGE
        );

        $this->assertEquals($expectedPayload, $exception->getMessage());
    }
}
