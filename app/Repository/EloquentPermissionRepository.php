<?php

namespace App\Repository;

use App\Model\Permission;
use App\Contract\Repository\PermissionRepositoryInterface;

class EloquentPermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $role)
    {
        parent::__construct($role);
    }
}
