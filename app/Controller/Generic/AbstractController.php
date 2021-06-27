<?php

declare(strict_types=1);

namespace App\Controller\Generic;

use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

abstract class AbstractController
{
    /**
     * @Inject
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @Inject
     * @var RequestInterface
     */
    protected $request;

    /**
     * @Inject
     * @var ResponseInterface
     */
    protected $response;
}
