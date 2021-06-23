<?php

namespace App\Controller;

use App\Request\SegmentRequest;
use Hyperf\Di\Annotation\Inject;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PostMapping;
use App\Contract\Repository\SegmentRepositoryInterface;

/**
 * @Controller(prefix="api/v1/segments")
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
     * @PostMapping(path="")
     */
    public function createOneSegment(SegmentRequest $request): void
    {
    }
}
