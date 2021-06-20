<?php

namespace App\Controller;

use App\Contracts\Repository\SegmentRepositoryInterface;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpMessage\Exception\NotFoundHttpException;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use Psr\Http\Message\ResponseInterface;

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
     * @PutMapping(path="{segmentId}")
     */
    public function updateOneSegment(int $segmentId): ResponseInterface
    {
    }
}
