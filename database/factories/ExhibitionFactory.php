<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Exhibition>
 */
class ExhibitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(),
            'tags' => 'modern, children, media art',
            'location' => $this->faker->city(),
            'description' => $this->faker->paragraph(5),
            'start_date' => '2023-09-25',
            'end_date' => '2023-11-25',
            'views' => 0,

        ];
    }
}
