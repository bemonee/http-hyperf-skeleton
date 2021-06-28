<?php

declare(strict_types=1);

namespace App\Model\Generic;

use Hyperf\ModelCache\Cacheable;
use Hyperf\ModelCache\CacheableInterface;
use Hyperf\Database\Model\Concerns\HasTimestamps;
use Hyperf\DbConnection\Model\Model as BaseModel;

abstract class Model extends BaseModel implements CacheableInterface
{
    use Cacheable;
    use HasTimestamps;
}
