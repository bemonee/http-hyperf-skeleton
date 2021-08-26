<?php

declare(strict_types=1);

namespace Test\Cases\Controller;

use Test\Utils\Controller\CrudControllerTestCase;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;

final class SegmentControllerTest extends CrudControllerTestCase
{
    private const BASE_URL = '/api/v1/segments';

    private const SEGMENT_NAMES = [
        'a-segment',
        'another-segment'
    ];

    public function __construct()
    {
        parent::__construct(SegmentRepositoryInterface::class);
    }

    public function testGetAllSegmentsEmpty(): void
    {
        $emptySegments = $this->get(self::BASE_URL);

        $this->assertEmpty($emptySegments);
    }

    public function testGetAllSegmentsWithValues(): void
    {
        foreach (self::SEGMENT_NAMES as $segmentName) {
            $this->repository->create([
                'name' => $segmentName,
            ]);
        }

        $segments = $this->repository->all();

        $this->assertNotEmpty($segments);

        $emptySegments = $this->get(self::BASE_URL);

        //var_dump($emptySegments);

        $this->assertEmpty($emptySegments);
    }
}
