<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\BelongsToMany;

class Tenant extends Model
{
    protected $table = 'tenants';
    protected $visible = ['id', 'tenant_id', 'name'];

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }

    public function apps(): BelongsToMany
    {
        return $this->belongsToMany(App::class);
    }
}
