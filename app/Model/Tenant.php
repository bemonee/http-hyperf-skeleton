<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\HasMany;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $segment_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|PurchasedApp[] $purchases
 * @property-read Segment $segment
 */
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
