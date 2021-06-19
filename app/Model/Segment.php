<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\HasMany;

class Segment extends Model
{
    protected $table = 'segments';

    protected $visible = ['id', 'name'];

    protected $fillable = ['name'];

    public function tenants(): HasMany
    {
        return $this->hasMany(Tenant::class);
    }
}
