<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Domain;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        return [
            'title' => $this->faker->randomElement(['ads1', 'ads2', 'ads3', 'ads4', 'ads5']),
            'slug' => $this->faker->slug(),
            'text' => $this->faker->text(),
            'phone' => $this->faker->phoneNumber(),
            'user_id' =>  User::all()->random()->id,
            'domain_id' =>  Domain::all()->random()->id
        ];
    }
    // City::all()->random()->id
}
