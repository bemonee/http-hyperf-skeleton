<?php

declare(strict_types=1);

namespace Test\Cases\Model;

use PHPUnit\Framework\TestCase;

final class SegmentTest extends TestCase
{
    private const A_SEGMENT = [
        'id' => 1,
        'name' => 'Fintech'
    ];

    public function testSegmentCreation(): void
    {
        $aSegment = (new Segment())
            ->setId(self::A_SEGMENT['id'])
            ->setName(self::A_SEGMENT['name']);

        $this->assertEquals($aSegment->getId(), self::A_SEGMENT['id']);
        $this->assertEquals($aSegment->getName(), self::A_SEGMENT['name']);
    }
}
