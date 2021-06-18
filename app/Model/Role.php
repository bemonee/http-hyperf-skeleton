<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;

class Role extends Model
{
    protected $table = 'roles';
    protected $visible = ['id', 'app_id', 'name'];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }
}
