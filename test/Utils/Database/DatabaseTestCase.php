<?php

declare(strict_types=1);

namespace Test\Utils\Database;

use PHPUnit\Framework\TestCase;
use App\Contract\Repository\Generic\RepositoryInterface;

abstract class DatabaseTestCase extends TestCase
{
    use DatabaseTransactionTrait {
        setUp as traitSetUp;
        tearDown as traitTearDown;
    }

    protected RepositoryInterface $repository;

    public function __construct(RepositoryInterface $repository, $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->repository = $repository;
    }

    protected function setUp(): void
    {
        $this->traitSetUp();

        $this->concreteSetUp();
    }

    protected function tearDown(): void
    {
        $this->traitTearDown();

        $this->concreteTearDown();
    }

    protected function concreteSetUp(): void
    {
    }

    protected function concreteTearDown(): void
    {
    }
}
