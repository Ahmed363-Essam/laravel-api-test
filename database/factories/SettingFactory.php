<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SettingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'about_us' => $this->faker->name(),
            'why_us'=>$this->faker->paragraph(),
            'goal' => $this->faker->title(),
            'about_footer'=>$this->faker->text(),
            'activities_text'=>$this->faker->text()
        ];
    }
}
