<?php

declare(strict_types=1);

namespace App\Model\Role;

use Carbon\Carbon;
use App\Model\App\App;
use App\Model\Generic\Model;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $app_id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read App $app
 */
class Role extends Model
{
    protected $table = 'roles';

    protected $visible = ['id', 'name'];

    protected $fillable = ['app_id', 'name'];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }
}
