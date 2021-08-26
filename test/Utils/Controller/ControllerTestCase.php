<?php

declare(strict_types=1);

namespace Test\Utils\Controller;

use Hyperf\Testing\Client;
use PHPUnit\Framework\TestCase;
use Test\Utils\Database\RefreshDatabaseTrait;

/**
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 * @method request($method, $path, $options = [])
 */
abstract class ControllerTestCase extends TestCase
{
    use RefreshDatabaseTrait;

    protected Client $client;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->client = make(Client::class);
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->refreshDatabase();
    }
}
