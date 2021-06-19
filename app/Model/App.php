<?php

declare(strict_types=1);

namespace App\Model;

use Hyperf\Database\Model\Relations\HasMany;

class App extends Model
{
    protected $table = 'apps';

    protected $visible = ['id', 'name'];

    protected $fillable = ['name'];

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class);
    }

    public function plans(): HasMany
    {
        return $this->hasMany(PaymentPlan::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(PurchasedApp::class);
    }
}
