<?php

namespace App\Model;

use Carbon\Carbon;
use Hyperf\Database\Model\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $app_id
 * @property string $name
 * @property string $price
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read App $app
 */
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
