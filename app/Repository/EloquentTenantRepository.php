<?php

namespace App\Repository;

use App\Model\Tenant;
use App\Contract\Repository\TenantRepositoryInterface;

class EloquentTenantRepository extends EloquentRepository implements TenantRepositoryInterface
{
    public function __construct(Tenant $tenant)
    {
        parent::__construct($tenant);
    }
}
