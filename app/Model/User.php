<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\HasMany;

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
        $this->attributes['first_name'] = ucwords(strtolower($firstName));
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
        return $this->hasMany(User::class);
    }
}
