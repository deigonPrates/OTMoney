<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use JetBrains\PhpStorm\Pure;
use NumberFormatter;

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

    /**
     * @return Attribute
     */
    protected function min(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->setMaskMoney($value),
            set: fn ($value) => $this->removeMaskMoney($value),
        );
    }

    /**
     * @return Attribute
     */
    protected function max(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $this->setMaskMoney($value),
            set: fn ($value) => $this->removeMaskMoney($value),
        );
    }

    /**
     * @param $value
     * @return string
     */
    #[Pure] private function setMaskMoney($value): string
    {
       return number_format($value, 2, ',', '.');
    }

    /**
     * @param $value
     * @return float
     */
    private function removeMaskMoney($value): float
    {
        $value = str_replace('.', '', $value);
        $value = str_replace(',', '.', $value);
        return  (float) $value;
    }

}
