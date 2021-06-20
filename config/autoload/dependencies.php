<?php

declare(strict_types=1);

use App\Contracts\Repository\SegmentRepositoryInterface;
use App\Repository\EloquentSegmentRepository;

return [
    SegmentRepositoryInterface::class => EloquentSegmentRepository::class
];
