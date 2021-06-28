<?php

declare(strict_types=1);

namespace App\Controller\Generic;

use Hyperf\HttpServer\Response;
use Hyperf\Di\Annotation\Inject;
use Psr\Container\ContainerInterface;
use App\Constants\Http\HttpStatusCodes;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

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

    protected function noContent(): Psr7ResponseInterface
    {
        return (new Response())->withStatus(HttpStatusCodes::HTTP_NO_CONTENT);
    }
}
