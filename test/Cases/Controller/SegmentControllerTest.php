<?php

declare(strict_types=1);

namespace Test\Cases\Controller;

use App\Constants\Http\HttpStatusCodes;
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

    public function testGetOneThatDoesntExists(): void
    {
        $invalidResponse = $this->client->get(self::BASE_URL.'/1');

        $this->assertFalse($invalidResponse['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_NOT_FOUND, $invalidResponse['status']);

        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_NOT_FOUND);

        $this->assertEquals($expectedError, $invalidResponse['error']);
    }

    public function testGetOneThatExists(): void
    {
        $createdSegment = $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[0],
        ]);

        $foundSegment = $this->client->get(self::BASE_URL.'/'.$createdSegment['id']);

        $this->assertEquals($createdSegment, $foundSegment);
    }

    public function testCreateOneInvalidSegment(): void
    {
        $invalidResponse = $this->client->post(self::BASE_URL, [
            'non-existent-property' => 'a-dummy-value',
        ]);

        $this->assertFalse($invalidResponse['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY, $invalidResponse['status']);

        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_UNPROCESSABLE_ENTITY);

        $this->assertEquals($expectedError, $invalidResponse['error']);
    }

    public function testCreateDuplicatedShouldThrowConflict(): void
    {
        $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[0],
        ]);

        $invalidResponse = $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[0],
        ]);

        $this->assertFalse($invalidResponse['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_CONFLICT, $invalidResponse['status']);

        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_CONFLICT);

        $this->assertEquals($expectedError, $invalidResponse['error']);
    }

    public function testUpdateOneSegment()
    {
        $createdSegment = $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[0],
        ]);

        $updateResponse = $this->client->put(self::BASE_URL.'/'.$createdSegment['id'], [
            'name' => self::SEGMENT_NAMES[1]
        ]);

        $this->assertNull($updateResponse);

        $foundUpdatedSegment = $this->client->get(self::BASE_URL.'/'.$createdSegment['id']);

        $this->assertEquals($createdSegment['id'], $foundUpdatedSegment['id']);

        $this->assertEquals(self::SEGMENT_NAMES[1], $foundUpdatedSegment['name']);
    }

    public function testUpdateOneInvalidSegment()
    {
        $invalidResponse = $this->client->put(self::BASE_URL.'/1', [
            'name' => self::SEGMENT_NAMES[0]
        ]);

        $this->assertFalse($invalidResponse['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_NOT_FOUND, $invalidResponse['status']);

        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_NOT_FOUND);

        $this->assertEquals($expectedError, $invalidResponse['error']);
    }

    public function testUpdateShouldThrowConflict()
    {
        $createdSegment = $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[0],
        ]);

        $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[1],
        ]);

        $invalidResponse = $this->client->put(self::BASE_URL.'/'.$createdSegment['id'], [
            'name' => self::SEGMENT_NAMES[1]
        ]);

        $this->assertFalse($invalidResponse['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_CONFLICT, $invalidResponse['status']);

        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_CONFLICT);

        $this->assertEquals($expectedError, $invalidResponse['error']);
    }

    public function testDeleteOneSegment()
    {
        $createdSegment = $this->client->post(self::BASE_URL, [
            'name' => self::SEGMENT_NAMES[0],
        ]);

        $deleteResponse = $this->client->delete(self::BASE_URL.'/'.$createdSegment['id']);

        $this->assertNull($deleteResponse);
    }

    public function testDeleteOneNonExistentSegmentShouldThrowNotFound()
    {
        $invalidResponse = $this->client->delete(self::BASE_URL.'/1');

        $this->assertFalse($invalidResponse['success']);

        $this->assertEquals(HttpStatusCodes::HTTP_NOT_FOUND, $invalidResponse['status']);

        $expectedError = HttpStatusCodes::getMessageForCode(HttpStatusCodes::HTTP_NOT_FOUND);

        $this->assertEquals($expectedError, $invalidResponse['error']);
    }

    public function testDummy(): bool
    {
        $this->assertTrue(false);
    }
}
