<?php

declare(strict_types=1);

namespace Test\Utils\Database;

use Hyperf\DbConnection\Db;
use Hyperf\Utils\ApplicationContext;

trait DatabaseTransactionTrait
{
    protected function setUp(): void
    {
        parent::setUp();

        ApplicationContext::getContainer()->get(Db::class)->beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        ApplicationContext::getContainer()->get(Db::class)->rollBack();
    }
}
