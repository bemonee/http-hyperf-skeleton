<?php

declare(strict_types=1);

use App\Repository\EloquentSegmentRepository;
use App\Contract\Repository\SegmentRepositoryInterface;

return [
    SegmentRepositoryInterface::class => EloquentSegmentRepository::class
];
