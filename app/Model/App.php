<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\HasMany;

class App extends Model
{
    protected $table = 'apps';
    protected $visible = ['id', 'name'];

    private function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function getRoles(): Collection
    {
        return $this->roles()->get();
    }

    public function addRole(Role $role): Role
    {
        return $this->roles()->save($role);
    }

    /** @todo Define ManyToMany tenant relationship */
}
