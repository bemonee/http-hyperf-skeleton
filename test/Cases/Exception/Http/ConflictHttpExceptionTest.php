<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Http;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Test\Mocks\Model\DummyModel;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;
use App\Exception\Http\ConflictHttpException;

final class ConflictHttpExceptionTest extends TestCase
{
    private const EXPECTED_MESSAGE = 'A DummyModel with that input already exists';

    public function testConstructor(): void
    {
        Carbon::setTestNow(Carbon::now());

        $exception = new ConflictHttpException((new DummyModel()));

        $this->assertEquals(
            HttpStatusCodes::HTTP_CONFLICT,
            $exception->getStatusCode()
        );

        $expectedPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_CONFLICT,
            self::EXPECTED_MESSAGE
        );

        $this->assertEquals($expectedPayload, $exception->getMessage());
    }
}
