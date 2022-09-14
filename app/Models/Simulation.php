<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Simulation
 *
 * @property int $id
 * @property int $user_id
 * @property int $payment_method_id
 * @property int $charge_id
 * @property string $origin
 * @property string $destiny
 * @property string $quotation
 * @property string $gross
 * @property string $liquid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereChargeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereDestiny($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereGross($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereLiquid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereOrigin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation wherePaymentMethodId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereQuotation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Simulation whereUserId($value)
 * @mixin \Eloquent
 */
class Simulation extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'payment_method_id',
        'origin',
        'destiny',
        'quotation',
        'gross',
        'liquid',
    ];
}
