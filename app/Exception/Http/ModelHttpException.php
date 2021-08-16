<?php

declare(strict_types=1);

namespace App\Exception\Http;

use ReflectionClass;
use App\Model\Generic\Model;

abstract class ModelHttpException extends HttpErrorException
{
    protected function getModelClassNameWithoutNamespace(Model $model): string
    {
        return (new ReflectionClass($model))->getShortName();
    }
}
