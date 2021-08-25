<?php

declare(strict_types=1);

namespace App\Controller\Generic;

use Hyperf\HttpServer\Response;
use App\Constants\Http\HttpStatusCodes;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

abstract class AbstractController
{
    protected RequestInterface $request;

    protected ResponseInterface $response;

    public function __construct(RequestInterface $request, ResponseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    protected function noContent(): Psr7ResponseInterface
    {
        return (new Response())->withStatus(HttpStatusCodes::HTTP_NO_CONTENT);
    }
}
