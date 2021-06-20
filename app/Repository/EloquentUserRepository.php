<?php

namespace App\Repository;

use App\Model\User;
use App\Contract\Repository\UserRepositoryInterface;

class EloquentUserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
