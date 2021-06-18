<?php


namespace App\Repository;

use App\Contracts\Repository\UserRepositoryInterface;
use App\Model\User;

class EloquentUserRepository extends EloquentRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
}
