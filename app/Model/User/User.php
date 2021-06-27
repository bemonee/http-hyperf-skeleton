<?php

declare(strict_types=1);

namespace App\Model\User;

use Carbon\Carbon;
use Hyperf\Utils\Str;
use App\Model\Generic\Model;
use App\Model\Permission\Permission;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property string $password
 * @property-read string $full_name
 * @property-read Collection|Permission[] $permissions
 */
class User extends Model
{
    protected $table = 'users';

    protected $visible = ['id', 'email', 'first_name', 'last_name'];

    protected $hidden = ['password'];

    protected $fillable = ['email', 'first_name', 'last_name', 'password'];

    public function setEmailAttribute(string $email): void
    {
        $this->attributes['email'] = strtolower($email);
    }

    public function setFirstNameAttribute(string $firstName): void
    {
        $this->attributes['first_name'] = Str::title($firstName);
    }

    public function setLastNameAttribute(string $lastName): void
    {
        $this->attributes['last_name'] = Str::title($lastName);
    }

    public function getFullNameAttribute(): string
    {
        return "{$this->last_name}, {$this->first_name}";
    }

    public function setPasswordAttribute(string $password): void
    {
        $this->attributes['password'] = password_hash($password, PASSWORD_DEFAULT);
    }

    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class);
    }
}
