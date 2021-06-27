<?php

declare(strict_types=1);

namespace App\Model\App;

use Carbon\Carbon;
use App\Model\Role\Role;
use App\Model\Generic\Model;
use Hyperf\Database\Model\Collection;
use Hyperf\Database\Model\Relations\HasMany;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read Collection|PaymentPlan[] $plans
 * @property-read Collection|PurchasedApp[] $purchases
 * @property-read Collection|Role[] $roles
 */
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
