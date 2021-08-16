<?php

declare(strict_types=1);

namespace Test\Cases\Constants\Http;

use PHPUnit\Framework\TestCase;
use App\Constants\Http\HttpStatusCodes;

final class HttpStatusCodesTest extends TestCase
{
    private const EXPECTED_BAD_REQUEST_MESSAGE = '400 Bad Request';

    public function testGetMessageForCode()
    {
        $this->assertEquals(
            self::EXPECTED_BAD_REQUEST_MESSAGE,
            HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_BAD_REQUEST)
        );
    }

    public function testIsError()
    {
        $this->assertNotTrue(
            HttpStatusCodes::isError(HttpStatusCodes::HTTP_CREATED)
        );

        $this->assertTrue(
            HttpStatusCodes::isError(HttpStatusCodes::HTTP_BAD_REQUEST)
        );

        $this->assertTrue(
            HttpStatusCodes::isError(HttpStatusCodes::HTTP_INTERNAL_SERVER_ERROR)
        );
    }
}
