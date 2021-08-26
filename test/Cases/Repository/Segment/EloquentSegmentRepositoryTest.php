<?php

declare(strict_types=1);

namespace Test\Cases\Repository\Segment;

use App\Model\Generic\Model;
use App\Model\Segment\Segment;
use App\Contract\Exception\ConflictException;
use App\Contract\Exception\NotFoundException;
use App\Exception\Http\ConflictHttpException;
use Test\Utils\Repository\RepositoryTestCase;
use App\Repository\Segment\EloquentSegmentRepository;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;

class EloquentSegmentRepositoryTest extends RepositoryTestCase
{
    private const SEGMENT_NAMES = [
        'a-segment',
        'another-segment'
    ];

    public function __construct()
    {
        parent::__construct(SegmentRepositoryInterface::class);
    }

    public function testConstruction(): void
    {
        $model = new Segment();

        $repository = new EloquentSegmentRepository($model);

        $this->assertInstanceOf(EloquentSegmentRepository::class, $repository);
    }

    /**
     * @throws ConflictException
     */
    public function testCreateDuplicated()
    {
        $created = $this->repository->create([
            'name' => self::SEGMENT_NAMES[0]
        ]);

        $this->assertInstanceOf(Segment::class, $created);

        $this->expectException(ConflictHttpException::class);

        $this->repository->create([
            'name' => self::SEGMENT_NAMES[0]
        ]);
    }

    /**
     * @throws ConflictException
     */
    public function testCreateAndFindAll(): void
    {
        $this->createSegments();

        $segments = $this->repository->all();

        $this->assertCount(count(self::SEGMENT_NAMES), $segments);

        foreach ($segments as $index => $segment) {
            $this->assertEquals(self::SEGMENT_NAMES[$index], $segment->name);
        }
    }

    /**
     * @throws NotFoundException|ConflictException
     */
    public function testUpdate(): void
    {
        $this->createSegments();

        $segments = $this->repository->all();

        foreach ($segments as $segment) {
            $updated = $this->repository->update($segment->id, [
                'name' => "$segment->name-updated"
            ]);

            $this->assertTrue($updated);
        }

        $segments = $this->repository->all();

        foreach ($segments as $index => $segment) {
            $this->assertEquals(self::SEGMENT_NAMES[$index].'-updated', $segment->name);
        }
    }

    /**
     * @throws ConflictException
     * @throws NotFoundException
     */
    public function testUpdateDuplicated()
    {
        $this->createSegments();

        $segments = $this->repository->all();

        $this->expectException(ConflictHttpException::class);

        $this->repository->update($segments[0]->id, [
            'name' => $segments[1]->name
        ]);
    }

    /**
     * @throws NotFoundException|ConflictException
     */
    public function testDelete(): void
    {
        $this->createSegments();

        $segments = $this->repository->all();

        foreach ($segments as $segment) {
            $deleted = $this->repository->delete($segment->id);

            $this->assertTrue($deleted);
        }

        $this->assertCount(0, $this->repository->all());
    }

    /**
     * @throws NotFoundException|ConflictException
     */
    public function testFindById()
    {
        $this->createSegments();

        $segments = $this->repository->all();

        foreach ($segments as $segment) {
            $found = $this->repository->find($segment->id);

            $this->assertEquals($segment->id, $found->id);
        }
    }

    /**
     * @throws NotFoundException
     */
    public function testFindThrowsNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $this->repository->find(980);
    }

    /**
     * @throws ConflictException
     */
    private function createSegments(): void
    {
        foreach (self::SEGMENT_NAMES as $segmentName) {
            $created = $this->repository->create([
                'name' => $segmentName
            ]);

            $this->assertInstanceOf(Model::class, $created);
        }
    }
}
