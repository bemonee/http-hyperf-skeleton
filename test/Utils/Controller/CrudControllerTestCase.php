<?php

declare(strict_types=1);

namespace Test\Utils\Controller;

use Hyperf\Testing\Client;
use Test\Utils\Database\DatabaseTestCase;

/**
 * Class HttpTestCase.
 * @method get($uri, $data = [], $headers = [])
 * @method post($uri, $data = [], $headers = [])
 * @method json($uri, $data = [], $headers = [])
 * @method file($uri, $data = [], $headers = [])
 * @method request($method, $path, $options = [])
 */
abstract class CrudControllerTestCase extends DatabaseTestCase
{
    protected Client $client;

    public function __construct(string $repositoryName, $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($repositoryName, $name, $data, $dataName);

        $this->client = make(Client::class);
    }

    public function __call($name, $arguments)
    {
        return $this->client->{$name}(...$arguments);
    }
}
