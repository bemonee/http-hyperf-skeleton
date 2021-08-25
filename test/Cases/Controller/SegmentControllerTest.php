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

    private const A_SEGMENT_NAME = 'a-segment';

    public function __construct()
    {
        parent::__construct((new EloquentSegmentRepository((new Segment()))));
    }

    /**
     * @throws ConflictException
     */
    public function testGetAllSegments(): void
    {
        //$this->client->post(self::BASE_URL, ['name' => self::A_SEGMENT_NAME]);

        $response = $this->client->get(self::BASE_URL);
    }
}
