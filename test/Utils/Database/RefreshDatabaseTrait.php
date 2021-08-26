<?php

declare(strict_types=1);

namespace Test\Utils\Database;

use Hyperf\Utils\ApplicationContext;
use Hyperf\Contract\ApplicationInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\NullOutput;

trait RefreshDatabaseTrait
{
    protected function refreshDatabase()
    {
        $command = 'migrate:fresh';

        $app = ApplicationContext::getContainer()->get(ApplicationInterface::class);

        $app->setAutoExit(false);

        $input = new ArrayInput([]);

        $output = new NullOutput();

        return $app->find($command)->run($input, $output);
    }
}
