<?php

declare(strict_types=1);

namespace Test\Cases\Controller;

use Test\Utils\Controller\ControllerTestCase;

final class SegmentControllerTest extends ControllerTestCase
{
    private const BASE_URL = '/api/v1/segments';

    private const SEGMENT_NAMES = [
        'a-segment',
        'another-segment'
    ];

    public function testGetAllSegmentsEmpty(): void
    {
        $emptySegments = $this->get(self::BASE_URL);

        $this->assertEmpty($emptySegments);
    }

    public function testGetAllSegmentsWithValues(): void
    {
        foreach (self::SEGMENT_NAMES as $segmentName) {
            $this->client->post(self::BASE_URL, [
                'name' => $segmentName,
            ]);
        }

        $segments = $this->client->get(self::BASE_URL);

        $this->assertNotEmpty($segments);

        foreach ($segments as $index => $segment) {
            $this->assertEquals(self::SEGMENT_NAMES[$index], $segment['name']);
        }
    }
}
