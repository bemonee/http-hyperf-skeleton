<?php

namespace App\Exception\Http;

use App\Model\Model;
use ReflectionClass;
use App\Helpers\HttpStatusCodes;

final class NotFoundHttpException extends HttpErrorException
{
    public function __construct(Model $model, $id)
    {
        parent::__construct(
            HttpStatusCodes::HTTP_NOT_FOUND,
            "{$this->getModelClassNameWithoutNamespace($model)} with id $id not found"
        );
    }

    private function getModelClassNameWithoutNamespace(Model $model): string
    {
        return (new ReflectionClass($model))->getShortName();
    }
}
