<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SimulationCurrencies extends Model
{
    use HasFactory;
    protected $fillable = [
        'simulation_id',
        'currency',
        'quotation'
    ];

    public function simulation(){
        return $this->belongsTo(Simulation::class);
    }
}
