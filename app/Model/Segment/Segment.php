<?php

declare(strict_types=1);

namespace App\Model\Segment;

use Carbon\Carbon;
use App\Model\Generic\Model;
use App\Model\Tenant\Tenant;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|Tenant[] $tenants
 */
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
