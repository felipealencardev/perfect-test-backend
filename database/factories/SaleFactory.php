<?php

namespace Database\Factories;

use App\Models\Sale;
use Illuminate\Database\Eloquent\Factories\Factory;

class SaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $date = $this->faker->dateTimeBetween($startDate = '-5 days', $endDate = '-1 days')->format('d/m/Y');
        return [
            'product_id' => $this->faker->numberBetween(1, 3),
            'client_id' => $this->faker->numberBetween(1, 3),
            'date' => $date,
            'quantity' => $this->faker->numberBetween(1, 10),
            'discount' => $this->faker->numberBetween(1, 20),
            'status_id' => $this->faker->numberBetween(1, 3)
        ];
    }
}
