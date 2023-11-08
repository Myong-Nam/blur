<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

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
            'thumbnail_image' => function () {
                $exhibiton_images = Storage::disk('exhibitionimages')->allFiles();
                $random_keys = array_rand($exhibiton_images, 1);
                return 'exhibition_images/' . $exhibiton_images[$random_keys];
            },
            'views' => 0,

        ];
    }
}
