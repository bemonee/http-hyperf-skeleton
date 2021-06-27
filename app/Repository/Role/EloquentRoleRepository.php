<?php

namespace App\Repository\Role;

use App\Model\Role\Role;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\Role\RoleRepositoryInterface;

class EloquentRoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
