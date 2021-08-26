<?php

declare(strict_types=1);

namespace Test\Cases\Helpers\Http;

use PHPUnit\Framework\TestCase;
use App\Helpers\Http\HttpErrorHelper;
use App\Constants\Http\HttpStatusCodes;

final class HttpErrorHelperTest extends TestCase
{
    private const A_DUMMY_MESSAGE = 'a-dummy-message';

    public function testGenerateHttpErrorMessage(): void
    {
        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_BAD_REQUEST);

        $expectedPayload = [
            'success' => false,
            'status' => HttpStatusCodes::HTTP_BAD_REQUEST,
            'error' => $expectedError,
            'message' => self::A_DUMMY_MESSAGE,
            'timestamp' => '',
        ];

        $actualPayload = HttpErrorHelper::generateHttpErrorMessage(
            HttpStatusCodes::HTTP_BAD_REQUEST,
            self::A_DUMMY_MESSAGE
        );

        $actualArrayPayload = json_decode($actualPayload, true);

        $expectedPayload['timestamp'] = $actualArrayPayload['timestamp'];

        $this->assertEquals(false, $actualArrayPayload['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_BAD_REQUEST, $actualArrayPayload['status']);

        $this->assertEquals($expectedError, $actualArrayPayload['error']);

        $this->assertEquals(self::A_DUMMY_MESSAGE, $actualArrayPayload['message']);

        $this->assertIsString($actualArrayPayload['timestamp']);

        $this->assertEquals(json_encode($expectedPayload), $actualPayload);
    }
}
