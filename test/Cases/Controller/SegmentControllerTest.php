<?php

declare(strict_types=1);

namespace Test\Cases\Controller;

use App\Model\Segment\Segment;
use App\Contract\Exception\ConflictException;
use Test\Utils\Controller\CrudControllerTestCase;
use App\Repository\Segment\EloquentSegmentRepository;

final class SegmentControllerTest extends CrudControllerTestCase
{
    private const BASE_URL = '/api/v1/segments';

    private const SEGMENT_NAMES = [
        'a-segment',
        'another-segment'
    ];

    public function __construct()
    {
        parent::__construct((new EloquentSegmentRepository((new Segment()))));
    }

    /**
     * @throws ConflictException
     */
    public function testGetAllSegments(): void
    {
        $emptySegments = $this->get(self::BASE_URL);

        $this->assertEmpty($emptySegments);

        foreach (self::SEGMENT_NAMES as $segmentName) {
            $this->repository->create([
                'name' => $segmentName
            ]);
        }

        $twoSegments = $this->get(self::BASE_URL);
        var_dump($twoSegments);
        //$this->assertCount(2, $twoSegments);
    }
}
