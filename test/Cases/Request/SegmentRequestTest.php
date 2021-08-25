<?php

declare(strict_types=1);

namespace Test\Cases\Request;

use PHPUnit\Framework\TestCase;
use Hyperf\Utils\ApplicationContext;
use App\Request\Segment\SegmentRequest;

final class SegmentRequestTest extends TestCase
{
    private const EXPECTED_VALIDATION_RULES = [
        'name' => 'required|max:255'
    ];

    private SegmentRequest $segmentRequest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->segmentRequest = new SegmentRequest(
            ApplicationContext::getContainer()
        );
    }

    public function testAuthorize(): void
    {
        $this->assertTrue($this->segmentRequest->authorize());
    }

    public function testRules(): void
    {
        $this->assertEquals(
            self::EXPECTED_VALIDATION_RULES,
            $this->segmentRequest->rules()
        );
    }
}
