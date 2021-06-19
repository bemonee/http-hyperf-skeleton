<?php


namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;
use Hyperf\Database\Model\Relations\HasOne;

class PurchasedApp extends Model
{
    protected $table = 'purchased_apps';

    protected $visible = ['id', 'tenant_id', 'app_id', 'plan_id', 'purchased_at', 'expired_at'];

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
