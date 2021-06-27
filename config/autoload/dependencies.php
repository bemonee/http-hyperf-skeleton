<?php

declare(strict_types=1);

use App\Repository\App\EloquentAppRepository;
use App\Repository\Role\EloquentRoleRepository;
use App\Repository\User\EloquentUserRepository;
use App\Repository\Tenant\EloquentTenantRepository;
use App\Repository\Segment\EloquentSegmentRepository;
use App\Contract\Repository\App\AppRepositoryInterface;
use App\Contract\Repository\Role\RoleRepositoryInterface;
use App\Contract\Repository\User\UserRepositoryInterface;
use App\Repository\Permission\EloquentPermissionRepository;
use App\Contract\Repository\Tenant\TenantRepositoryInterface;
use App\Contract\Repository\Segment\SegmentRepositoryInterface;
use App\Contract\Repository\Permission\PermissionRepositoryInterface;

return [
    AppRepositoryInterface::class => EloquentAppRepository::class,
    PermissionRepositoryInterface::class => EloquentPermissionRepository::class,
    RoleRepositoryInterface::class => EloquentRoleRepository::class,
    SegmentRepositoryInterface::class => EloquentSegmentRepository::class,
    TenantRepositoryInterface::class => EloquentTenantRepository::class,
    UserRepositoryInterface::class => EloquentUserRepository::class,
];
