<?php

namespace App\Exception\Http;

use App\Constants\Http\HttpStatusCodes;

final class UnauthorizedHttpException extends HttpErrorException
{
    public function __construct(string $reason = null)
    {
        $message = 'User must be authenticated to perform this action';

        if ($reason !== null) {
            $message .= ' - Reason: ' . $reason;
        }

        parent::__construct(HttpStatusCodes::HTTP_FORBIDDEN, $message);
    }
}
