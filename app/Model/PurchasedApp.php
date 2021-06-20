<?php

namespace App\Model;

use Carbon\Carbon;
use Hyperf\Database\Model\Relations\HasOne;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $tenant_id
 * @property int $app_id
 * @property int $payment_plan_id
 * @property string $purchased_at
 * @property string $expired_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read App $app
 * @property-read PaymentPlan $plan
 * @property-read Tenant $tenant
 */
class PurchasedApp extends Model
{
    protected $table = 'purchased_apps';

    protected $visible = ['id', 'tenant_id', 'app_id', 'payment_plan_id', 'purchased_at', 'expired_at'];

    protected $fillable = ['tenant_id', 'app_id', 'payment_plan_id', 'purchased_at', 'expired_at'];

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }

    public function plan(): HasOne
    {
        return $this->hasOne(PaymentPlan::class);
    }
}
