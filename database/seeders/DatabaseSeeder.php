<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Product;
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
    }
}
