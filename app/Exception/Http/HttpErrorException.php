<?php

namespace App\Exception\Http;

use Carbon\Carbon;
use App\Helpers\HttpStatusCodes;
use Hyperf\HttpMessage\Exception\HttpException;

abstract class HttpErrorException extends HttpException
{
    public function __construct(int $httpCode, string $message = null)
    {
        parent::__construct(
            $httpCode,
            $this->generateHttpErrorMessage($httpCode, $message)
        );
    }

    private function generateHttpErrorMessage(int $httpCode, string $message): string
    {
        return json_encode([
            'success' => !HttpStatusCodes::isError($httpCode),
            'status' => $httpCode,
            'error' => HttpStatusCodes::getMessageForCode($httpCode),
            'message' => $message,
            'timestamp' => Carbon::now()->toAtomString(),
        ]);
    }
}
