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
    /** @Inject */
    protected ContainerInterface $container;

    /** @Inject */
    protected RequestInterface $request;

    /** @Inject */
    protected ResponseInterface $response;

    protected function noContent(): Psr7ResponseInterface
    {
        return (new Response())->withStatus(HttpStatusCodes::HTTP_NO_CONTENT);
    }
}
