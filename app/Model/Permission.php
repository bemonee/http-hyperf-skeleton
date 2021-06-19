<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\HasOne;

class Permission extends Model
{
    protected $table = 'permissions';

    protected $visible = ['role_id'];

    protected $fillable = ['user_id', 'role_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function role(): HasOne
    {
        return $this->hasOne(Role::class);
    }
}
