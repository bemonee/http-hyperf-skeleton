<?php

namespace App\Repository;

use App\Contracts\Repository\AppRepositoryInterface;
use App\Model\App;

class EloquentAppRepository extends EloquentRepository implements AppRepositoryInterface
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
}
