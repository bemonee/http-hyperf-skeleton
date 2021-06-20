<?php

declare(strict_types=1);

namespace App\Model;

use Carbon\Carbon;
use Hyperf\Database\Model\Relations\HasOne;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Role $role
 * @property-read User $user
 */
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
