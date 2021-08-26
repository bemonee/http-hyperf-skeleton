<?php

declare(strict_types=1);

namespace Test\Utils\Database;

use Hyperf\DbConnection\Db;
use Hyperf\Utils\ApplicationContext;

trait DatabaseTransactionTrait
{
    protected function beginTransaction(): void
    {
        ApplicationContext::getContainer()->get(Db::class)->beginTransaction();
    }

    protected function rollbackTransaction(): void
    {
        ApplicationContext::getContainer()->get(Db::class)->rollBack();
    }
}
