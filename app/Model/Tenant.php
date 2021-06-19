<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\HasMany;

class Tenant extends Model
{
    protected $table = 'tenants';

    protected $visible = ['id', 'name'];

    protected $fillable = ['name', 'segment_id'];

    public function segment(): BelongsTo
    {
        return $this->belongsTo(Segment::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(PurchasedApp::class);
    }
}
