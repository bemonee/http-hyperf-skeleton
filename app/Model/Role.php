<?php

declare(strict_types=1);

namespace App\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $visible = ['id', 'app_id', 'name'];

    /** @todo Define app relationship */
}
