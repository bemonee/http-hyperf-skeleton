<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsToMany;
use Hyperf\Database\Model\Relations\HasMany;

class App extends Model
{
    protected $table = 'apps';
    protected $visible = ['id', 'name'];

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function tenants(): BelongsToMany
    {
        return $this->belongsToMany(Tenant::class);
    }
}
