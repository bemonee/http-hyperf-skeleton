<?php

namespace App\Repository;

use App\Model\Segment;
use App\Contract\Repository\SegmentRepositoryInterface;

class EloquentSegmentRepository extends EloquentRepository implements SegmentRepositoryInterface
{
    public function __construct(Segment $segment)
    {
        parent::__construct($segment);
    }
}
