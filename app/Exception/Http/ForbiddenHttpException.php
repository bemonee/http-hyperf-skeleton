<?php

namespace App\Exception\Http;

use App\Constants\Http\HttpStatusCodes;

final class ForbiddenHttpException extends HttpErrorException
{
    public function __construct()
    {
        parent::__construct(
            HttpStatusCodes::HTTP_FORBIDDEN,
            "User is not authorized to perform this action"
        );
    }
}
