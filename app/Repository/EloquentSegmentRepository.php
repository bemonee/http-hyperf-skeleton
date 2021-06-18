<?php

namespace App\Repository;

use App\Contracts\Repository\SegmentRepositoryInterface;
use App\Model\Segment;

class EloquentSegmentRepository extends EloquentRepository implements SegmentRepositoryInterface
{
    public function __construct(Segment $segment)
    {
        parent::__construct($segment);
    }
}
