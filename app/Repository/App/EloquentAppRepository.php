<?php

namespace App\Repository\App;

use App\Model\App\App;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\App\AppRepositoryInterface;

class EloquentAppRepository extends EloquentRepository implements AppRepositoryInterface
{
    public function __construct(App $app)
    {
        parent::__construct($app);
    }
}
