<?php

declare(strict_types=1);

namespace Test\Cases\Exception\Http;

use Carbon\Carbon;
use PHPUnit\Framework\TestCase;
use Test\Mocks\Model\DummyModel;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;
use App\Exception\Http\NotFoundHttpException;

final class NotFoundHttpExceptionTest extends TestCase
{
    private const A_DUMMY_MODEL_ID = 1;

    private const EXPECTED_MESSAGE = 'DummyModel with id '.self::A_DUMMY_MODEL_ID.' not found';

    public function testConstructor(): void
    {
        Carbon::setTestNow(Carbon::now());

        $exception = new NotFoundHttpException((new DummyModel()), 1);

        $this->assertEquals(
            HttpStatusCodes::HTTP_NOT_FOUND,
            $exception->getStatusCode()
        );

        $expectedPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_NOT_FOUND,
            self::EXPECTED_MESSAGE
        );

        $this->assertEquals($expectedPayload, $exception->getMessage());
    }
}
