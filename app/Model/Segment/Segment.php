<?php

declare(strict_types=1);

namespace App\Model\Segment;

use Carbon\Carbon;
use App\Model\Generic\Model;

/**
 * @property int $id
 * @property string $name
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Segment extends Model
{
    protected $table = 'segments';

    protected $visible = ['id', 'name'];

    protected $fillable = ['name'];
}
