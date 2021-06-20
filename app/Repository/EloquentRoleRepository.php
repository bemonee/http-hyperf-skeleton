<?php

namespace App\Repository;

use App\Model\Role;
use App\Contract\Repository\RoleRepositoryInterface;

class EloquentRoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
