<?php

declare(strict_types=1);

namespace App\Controller\Segment;

use Psr\Container\ContainerInterface;
use App\Request\Segment\SegmentRequest;
use Hyperf\HttpServer\Annotation\Controller;
use Hyperf\HttpServer\Annotation\GetMapping;
use Hyperf\HttpServer\Annotation\PutMapping;
use App\Contract\Exception\ConflictException;
use App\Contract\Exception\NotFoundException;
use Hyperf\HttpServer\Annotation\PostMapping;
use App\Controller\Generic\AbstractController;
use Hyperf\HttpServer\Annotation\DeleteMapping;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

/**
 * @Controller(prefix="api/v1/segments")
 */
class SegmentController extends AbstractController
{
    private SegmentRepositoryInterface $segmentRepository;

    public function __construct(
        ContainerInterface $container,
        RequestInterface $request,
        ResponseInterface $response,
        SegmentRepositoryInterface $segmentRepository
    ) {
        parent::__construct($container, $request, $response);

        $this->segmentRepository = $segmentRepository;
    }

    /**
     * @GetMapping(path="")
     */
    public function getAllSegments(): Psr7ResponseInterface
    {
        return $this->response->json(
            $this->segmentRepository->all()->toArray()
        );
    }

    /**
     * @GetMapping(path="{segmentId}")
     * @throws NotFoundException
     */
    public function getOneSegment(string $segmentId): Psr7ResponseInterface
    {
        return $this->response->json(
            $this->segmentRepository->find($segmentId)->toArray()
        );
    }

    /**
     * @PostMapping(path="")
     * @throws ConflictException
     */
    public function createOneSegment(SegmentRequest $request): Psr7ResponseInterface
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
    public function updateOneSegment(SegmentRequest $request, $segmentId): Psr7ResponseInterface
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
    public function deleteOneSegment($segmentId): Psr7ResponseInterface
    {
        $this->segmentRepository->delete($segmentId);

        return $this->noContent();
    }
}
