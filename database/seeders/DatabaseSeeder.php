<?php

namespace Database\Seeders;

use App\Models\Charge;
use App\Models\CurrencyCombination;
use App\Models\PaymentMethod;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

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

        $response = Http::get('https://economia.awesomeapi.com.br/json/available');
        $coins = $response->json();

        foreach ($coins as $key => $value){
            $coin        = explode('-', $key);
            $description = explode('/', $value);

            CurrencyCombination::create([
                'coin_origin'  => $coin[0],
                'name_origin'  => $description[0],
                'coin_destiny' => $coin[1],
                'name_destiny' => $description[1],
            ]);
        }

    }
}
