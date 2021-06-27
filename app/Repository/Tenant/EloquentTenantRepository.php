<?php

namespace App\Repository\Tenant;

use App\Model\Tenant\Tenant;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\Tenant\TenantRepositoryInterface;

class EloquentTenantRepository extends EloquentRepository implements TenantRepositoryInterface
{
    public function __construct(Tenant $tenant)
    {
        parent::__construct($tenant);
    }
}
