<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Status;
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
        Product::factory(3)->create();
        Client::factory(3)->create();
        Status::factory()->create([
            'label' => 'Aprovado',
            'value' => 'aprovado'
        ]);
        Status::factory()->create([
            'label' => 'Cancelado',
            'value' => 'cancelado'
        ]);
        Status::factory()->create([
            'label' => 'Devolvido',
            'value' => 'devolvido'
        ]);
        Sale::factory(10)->create();
    }
}
