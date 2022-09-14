<?php

namespace Database\Seeders;

use App\Models\Charge;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Charge::factory()->create([
            'value'  => 2,
            'min'    => 1,
            'max'    => 3000,
            'status' => 1
        ]);
        Charge::factory()->create([
            'value'  => 1,
            'min'    => 3000,
            'max'    => null,
            'status' => 1
        ]);

        PaymentMethod::factory()->create([
            'description' => 'Boleto',
            'rate'        => 1.45,
            'status' => 1
        ]);
        PaymentMethod::factory()->create([
            'description' => 'Cartão de Crédito',
            'rate'        => 7.63,
            'status' => 1
        ]);
    }
}
