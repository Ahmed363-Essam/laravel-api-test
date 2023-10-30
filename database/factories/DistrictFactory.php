<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

class DistrictFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'name' =>  $this->faker->unique()->randomElement(['Maadi', 'qualib', 'sina2', 'middlewest', 'doki', 'sharm']),
            'city_id' => City::all()->random()->id
        ];
    }
}
