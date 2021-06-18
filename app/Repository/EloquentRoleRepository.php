<?php


namespace App\Repository;

use App\Contracts\Repository\RoleRepositoryInterface;
use App\Model\Role;

class EloquentRoleRepository extends EloquentRepository implements RoleRepositoryInterface
{
    public function __construct(Role $role)
    {
        parent::__construct($role);
    }
}
