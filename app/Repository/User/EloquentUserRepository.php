<?php

namespace App\Repository\User;

use App\Model\User\User;
use App\Repository\Generic\EloquentRepository;
use App\Contract\Repository\User\UserRepositoryInterface;

class EloquentUserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
