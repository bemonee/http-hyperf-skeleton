<?php

namespace App\Repository\Permission;

use App\Model\Permission\Permission;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\Permission\PermissionRepositoryInterface;

class EloquentPermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $role)
    {
        parent::__construct($role);
    }
}
