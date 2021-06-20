<?php

namespace App\Repository;

use App\Model\App;
use App\Contract\Repository\AppRepositoryInterface;

class EloquentAppRepository extends EloquentRepository implements AppRepositoryInterface
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
}
