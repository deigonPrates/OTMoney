<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Charge
 *
 * @property int $id
 * @property string $value
 * @property string|null $min
 * @property string|null $max
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge query()
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereMax($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereMin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Charge whereValue($value)
 * @mixin \Eloquent
 */
class Charge extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'min',
        'max',
        'status',
    ];
}
