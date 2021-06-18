<?php


namespace App\Repository;

use App\Contracts\Repository\TenantRepositoryInterface;
use App\Model\Tenant;

class EloquentTenantRepository extends EloquentRepository implements TenantRepositoryInterface
{
    public function __construct(Tenant $tenant)
    {
        parent::__construct($tenant);
    }
}
