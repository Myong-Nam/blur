<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Type;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $type_names = ['Exhibition', 'Show', 'Festival', 'Education', 'Experience', 'etc'];
        $types = [];
        foreach ($type_names as $name) {
            $types = Type::factory()->create([
                'name' => $name,
            ]);
        }

        // $exhibition_type = $types[0];

        // $user = User::factory()->create([
        //     'name' => 'Test User 2',
        //     'email' => 'test2@example.com',
        // ]);

        // $exhibitions = Exhibition::factory(10)->create([
        //     'user_id' => $user->id,
        //     'category_id' => $exhibition_type->id,
        // ]);

    }
}
