<?php

namespace App\Controller;

use Hyperf\Di\Annotation\Inject;
use Laminas\Stdlib\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\Middleware;
use Hyperf\HttpServer\Annotation\PutMapping;
use App\Contract\Repository\SegmentRepositoryInterface;

/**
 * @Controller(prefix="api/v1/segments")
 * @Middleware()
 */
class SegmentController extends AbstractController
{
    /**
     * @Inject
     */
    private SegmentRepositoryInterface $segmentRepository;

    /**
     * @GetMapping(path="")
     */
    public function getAllSegments(): ResponseInterface
    {
        return $this->response->json(
            $this->segmentRepository->all()->toArray()
        );
    }

    /**
     * @GetMapping(path="{segmentId}")
     */
    public function getOneSegment(string $segmentId): ResponseInterface
    {
        return $this->response->json(
            $this->segmentRepository->find($segmentId)->toArray()
        );
    }

    /**
     * @PutMapping(path="{segmentId}")
     */
    public function updateOneSegment(RequestInterface $request): ResponseInterface
    {
    }
}
