<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'art' => mb_strtoupper($this->faker->unique()->bothify('???#########')),
            'name' => $this->faker->sentence(2),
            'status' => $this->faker->randomElement(['available', 'unavailable']),
            'data' => ['color' => $this->faker->randomElement(['white', 'black', 'green', 'olive', 'silver', 'purple', 'navy']), 'size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL', 'XXL'])],
        ];
    }
}
