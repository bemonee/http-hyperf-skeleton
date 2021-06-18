<?php


namespace App\Repository;

use App\Contracts\Repository\PermissionRepositoryInterface;
use App\Model\Permission;

class EloquentPermissionRepository extends EloquentRepository implements PermissionRepositoryInterface
{
    public function __construct(Permission $role)
    {
        parent::__construct($role);
    }
}
