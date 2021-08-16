<?php

declare(strict_types=1);

namespace App\Exception\Http;

use App\Model\Generic\Model;
use App\Constants\Http\HttpStatusCodes;
use App\Contract\Exception\ConflictException;

final class ConflictHttpException extends ModelHttpException implements ConflictException
{
    public function __construct(Model $model)
    {
        parent::__construct(
            HttpStatusCodes::HTTP_CONFLICT,
            "A {$this->getModelClassNameWithoutNamespace($model)} with that input already exists"
        );
    }
}
