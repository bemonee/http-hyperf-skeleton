<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;
use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel implements CacheableInterface
{
    use Cacheable;
}
