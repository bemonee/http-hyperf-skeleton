<?php

declare(strict_types=1);

namespace App\Exception\Http;

use App\Helpers\Http\HttpErrorHelper;
use Hyperf\HttpMessage\Exception\HttpException;

abstract class HttpErrorException extends HttpException
{
    public function __construct(int $httpCode, $message = null)
    {
        parent::__construct($httpCode, HttpErrorHelper::generateHttpErrorMessage($httpCode, $message));
    }
}
