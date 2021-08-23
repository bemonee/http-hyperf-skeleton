<?php

declare(strict_types=1);

namespace Test\Cases\Listener;

use Hyperf\Logger\Logger;
use Hyperf\Database\Connection;
use PHPUnit\Framework\TestCase;
use Hyperf\Logger\LoggerFactory;
use Monolog\Handler\StreamHandler;
use Monolog\Formatter\LineFormatter;
use App\Listener\DbQueryExecutedListener;
use Hyperf\Database\Events\QueryExecuted;

final class DbQueryExecutedListenerTest extends TestCase
{
    private const LOG_PATH = BASE_PATH.'/test/runtime/logs/dummy_sql.log';

    private const A_DUMMY_CONNECTION_NAME = 'App Mysql';

    private const A_DUMMY_SQL = "SELECT id FROM dummy_table WHERE id = ?";

    private const SQL_PARAMETERS = [1];

    private const EXECUTION_TIME = 0.15;

    private const EXPECTED_LOGGED_LINE = "[%executionTime%] %sql% [] []";

    private const LISTENED_EVENTS = [
        QueryExecuted::class
    ];

    private DbQueryExecutedListener $listener;

    protected function setUp(): void
    {
        parent::setUp();

        $this->deleteDummyLog();

        $this->listener = $this->getMockedListener();
    }

    protected function tearDown(): void
    {
        $this->deleteDummyLog();

        parent::tearDown();
    }

    public function testListenedEvents()
    {
        $this->assertEquals(self::LISTENED_EVENTS, $this->listener->listen());
    }

    public function testOnQueryExecuted(): void
    {
        $queryExecutedEvent = $this->getEvent();

        $this->listener->process($queryExecutedEvent);

        $actualContent = file_get_contents(self::LOG_PATH);

        $this->assertStringContainsString($this->getExpectedLine(), $actualContent);
    }

    private function getEvent(): QueryExecuted
    {
        $connection = $this->getMockBuilder(Connection::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getName'])
            ->getMock();

        $connection
            ->method('getName')
            ->willReturn(self::A_DUMMY_CONNECTION_NAME);

        return new QueryExecuted(
            self::A_DUMMY_SQL,
            self::SQL_PARAMETERS,
            self::EXECUTION_TIME,
            $connection
        );
    }

    private function getExpectedLine(): string
    {
        $expectedFileContent = self::EXPECTED_LOGGED_LINE;

        $expectedFileContent = str_replace('%executionTime%', (string) self::EXECUTION_TIME, $expectedFileContent);

        $sql = str_replace('?', "'".self::SQL_PARAMETERS[0]."'", self::A_DUMMY_SQL);

        $expectedFileContent = str_replace('%sql%', $sql, $expectedFileContent);

        $expectedFileContent .= PHP_EOL;

        return $expectedFileContent;
    }

    private function getMockedListener(): DbQueryExecutedListener
    {
        $loggerFactoryMock = $this->getMockBuilder(LoggerFactory::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['get'])
            ->getMock();

        $streamHandler = (new StreamHandler(self::LOG_PATH))->setFormatter(
            new LineFormatter(null, 'Y-m-d H:i:s', true)
        );

        $logger = new Logger('sql', [$streamHandler]);

        $loggerFactoryMock
            ->method('get')
            ->with('sql', 'default')
            ->willReturn($logger);

        return new DbQueryExecutedListener($loggerFactoryMock);
    }

    private function deleteDummyLog(): void
    {
        if (file_exists(self::LOG_PATH)) {
            unlink(self::LOG_PATH);
        }
    }
}
