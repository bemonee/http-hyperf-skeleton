<?php

declare(strict_types=1);

use App\Repository\Segment\EloquentSegmentRepository;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;

return [
    SegmentRepositoryInterface::class => EloquentSegmentRepository::class,
];
