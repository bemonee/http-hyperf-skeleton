<?php

namespace App\Exception\Http;

use App\Model\Generic\Model;
use App\Constants\Http\HttpStatusCodes;
use App\Contract\Exception\NotFoundException;

final class NotFoundHttpException extends ModelHttpException implements NotFoundException
{
    public function __construct(Model $model, $id)
    {
        parent::__construct(
            HttpStatusCodes::HTTP_NOT_FOUND,
            "{$this->getModelClassNameWithoutNamespace($model)} with id {$id} not found"
        );
    }
}
