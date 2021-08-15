<?php

declare(strict_types=1);

return [
    'handler' => [
        'http' => [
            App\Exception\Handler\HttpValidationExceptionHandler::class,
            App\Exception\Handler\JsonHttpExceptionHandler::class,
            App\Exception\Handler\AppExceptionHandler::class,
        ],
    ],
];
