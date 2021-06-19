<?php


namespace App\Model;

use Hyperf\Database\Model\Relations\BelongsTo;

class PaymentPlan extends Model
{
    protected $table = 'plans';

    protected $visible = ['id', 'name', 'price'];

    protected $fillable = ['app_id', 'name', 'price'];

    public function app(): BelongsTo
    {
        return $this->belongsTo(App::class);
    }
}
