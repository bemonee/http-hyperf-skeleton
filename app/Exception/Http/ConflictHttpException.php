<?php

namespace App\Exception\Http;

use App\Model\Generic\Model;
use App\Constants\Http\HttpStatusCodes;

final class ConflictHttpException extends ModelHttpException
{
    public function __construct(Model $model)
    {
        parent::__construct(
            HttpStatusCodes::HTTP_CONFLICT,
            "A {$this->getModelClassNameWithoutNamespace($model)} with that input already exists"
        );
    }
}
