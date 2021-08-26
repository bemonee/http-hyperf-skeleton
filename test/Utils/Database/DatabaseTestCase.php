<?php

declare(strict_types=1);

namespace Test\Utils\Database;

use PHPUnit\Framework\TestCase;
use Hyperf\Utils\ApplicationContext;
use App\Contract\Repository\Generic\RepositoryInterface;

abstract class DatabaseTestCase extends TestCase
{
    use DatabaseTransactionTrait;

    protected RepositoryInterface $repository;

    public function __construct(string $repositoryName, $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->repository = ApplicationContext::getContainer()->get($repositoryName);
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->beginTransaction();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->rollbackTransaction();
    }
}
