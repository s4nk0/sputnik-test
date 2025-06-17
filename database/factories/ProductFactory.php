<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->name(),
            'price'=>[
                'amount'=> $this->faker->numberBetween(1000,10000),
                'currency' =>'USD',
            ]
        ];
    }
}
