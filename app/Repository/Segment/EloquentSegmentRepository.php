<?php

namespace App\Repository\Segment;

use App\Model\Segment\Segment;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;

class EloquentSegmentRepository extends EloquentRepository implements SegmentRepositoryInterface
{
    public function __construct(Segment $segment)
    {
        parent::__construct($segment);
    }
}
