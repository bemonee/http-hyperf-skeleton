<?php

declare(strict_types=1);

namespace Test\Cases\Listener;

use Hyperf\Database\Connection;
use PHPUnit\Framework\TestCase;
use Hyperf\Logger\LoggerFactory;
use Hyperf\Event\EventDispatcher;
use Hyperf\Utils\ApplicationContext;
use Hyperf\Database\Events\QueryExecuted;
use Psr\EventDispatcher\EventDispatcherInterface;

final class DbQueryExecutedListenerTest extends TestCase
{
    private const A_DUMMY_CONNECTION_NAME = 'App Mysql';

    private const A_DUMMY_SQL = "SELECT id FROM dummy_table WHERE id = ?";

    private const SQL_PARAMETERS = [1];

    private const EXECUTION_TIME = 0.15;

    private EventDispatcherInterface $eventDispatcher;

    protected function setUp(): void
    {
        parent::setUp();

        $this->eventDispatcher = ApplicationContext::getContainer()->get(EventDispatcher::class);

        $logger = ApplicationContext::getContainer()->get(LoggerFactory::class)->get('sql');

        var_dump($logger);
    }

    public function testOnQueryExecuted(): void
    {
        $connection = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();

        $connection
            ->method('getName')
            ->willReturn(self::A_DUMMY_CONNECTION_NAME);

        $queryExecutedEvent = new QueryExecuted(
            self::A_DUMMY_SQL,
            self::SQL_PARAMETERS,
            self::EXECUTION_TIME,
            $connection
        );

        $this->eventDispatcher->dispatch($queryExecutedEvent);
    }
}
