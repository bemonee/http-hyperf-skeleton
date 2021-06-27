<?php

namespace App\Helpers;

use Carbon\Carbon;
use App\Constants\Http\HttpStatusCodes;

class HttpErrorHelper
{
    public static function generateHttpErrorMessage(int $httpCode, $message): string
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
