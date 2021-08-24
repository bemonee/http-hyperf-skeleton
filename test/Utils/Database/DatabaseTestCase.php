<?php

declare(strict_types=1);

namespace Test\Utils\Database;

use PHPUnit\Framework\TestCase;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\Generic\RepositoryInterface;

abstract class DatabaseTestCase extends TestCase
{
    protected RepositoryInterface $repository;

    use DatabaseTransactionTrait {
        setUp as traitSetUp;
        tearDown as traitTearDown;
    }

    protected function setUp(): void
    {
        $this->traitSetUp();

        $this->repository = $this->getRepository();

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

    abstract protected function getRepository(): EloquentRepository;
}
