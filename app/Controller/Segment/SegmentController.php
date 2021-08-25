<?php

declare(strict_types=1);

namespace App\Controller\Segment;

use App\Request\Segment\SegmentRequest;
use Psr\Http\Message\ResponseInterface;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use App\Contract\Exception\ConflictException;
use App\Contract\Exception\NotFoundException;
use Hyperf\HttpServer\Annotation\PostMapping;
use App\Controller\Generic\AbstractController;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;

/**
 * @Controller(prefix="api/v1/segments")
 */
class SegmentController extends AbstractController
{
    private SegmentRepositoryInterface $segmentRepository;

    public function __construct(
        RequestInterface $request,
        ResponseInterface $response,
        SegmentRepositoryInterface $segmentRepository
    ) {
        parent::__construct($request, $response);

        $this->segmentRepository = $segmentRepository;
    }

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
     * @throws NotFoundException
     */
    public function getOneSegment(string $segmentId): ResponseInterface
    {
        return $this->response->json(
            $this->segmentRepository->find($segmentId)->toArray()
        );
    }

    /**
     * @PostMapping(path="")
     * @throws ConflictException
     */
    public function createOneSegment(SegmentRequest $request): ResponseInterface
    {
        $validatedRequest = $request->validated();

        $this->segmentRepository->create([
            'name' => $validatedRequest['name']
        ]);

        return $this->noContent();
    }

    /**
     * @PutMapping(path="{segmentId}")
     * @throws NotFoundException
     */
    public function updateOneSegment(SegmentRequest $request, $segmentId): ResponseInterface
    {
        $validatedRequest = $request->validated();

        $this->segmentRepository->update($segmentId, [
            'name' => $validatedRequest['name']
        ]);

        return $this->noContent();
    }

    /**
     * @DeleteMapping(path="{segmentId}")
     * @throws NotFoundException
     */
    public function deleteOneSegment($segmentId): ResponseInterface
    {
        $this->segmentRepository->delete($segmentId);

        return $this->noContent();
    }
}
