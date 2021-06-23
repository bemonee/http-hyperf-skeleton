<?php

namespace App\Exception\Handler;

use Throwable;
use App\Helpers\HttpErrorHelper;
use Psr\Http\Message\ResponseInterface;
use Hyperf\Validation\ValidationException;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\ExceptionHandler\ExceptionHandler;

class HttpValidationExceptionHandler extends ExceptionHandler
{
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();

        /** @var ValidationException $throwable */
        $errors = array_combine(
            $throwable->validator->errors()->keys(),
            $throwable->validator->errors()->all()
        );

        if (! $response->hasHeader('content-type')) {
            $response = $response->withAddedHeader('content-type', 'application/json; charset=utf-8');
        }

        $message = HttpErrorHelper::generateHttpErrorMessage($throwable->status, $errors);

        return $response->withStatus($throwable->status)->withBody(new SwooleStream($message));
    }

    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationException;
    }
}
