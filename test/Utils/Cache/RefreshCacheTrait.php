<?php

declare(strict_types=1);

namespace Test\Utils\Cache;

use Hyperf\Redis\Redis;
use Hyperf\Utils\ApplicationContext;

trait RefreshCacheTrait
{
    protected function refreshCache(): void
    {
        $redis = ApplicationContext::getContainer()->get(Redis::class);

        $redis->del($redis->keys('*'));
    }
}
