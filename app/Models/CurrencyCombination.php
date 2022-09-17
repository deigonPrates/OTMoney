<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyCombination extends Model
{
    use HasFactory;
    protected $fillable = [
        'coin_origin',
        'name_origin',
        'coin_destiny',
        'name_destiny',
    ];
}
