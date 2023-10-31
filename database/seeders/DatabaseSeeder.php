<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Exhibition;
use App\Models\Type;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        //exhibition types
        $type_names = ['Exhibition', 'Show', 'Festival', 'Education', 'Experience', 'etc'];
        $exhibitions = [];

        // Creates exhibition types and exhibitions
        foreach ($type_names as $name) {
            $type = Type::factory()->create(['name' => $name]);
            $exhibitions_created = Exhibition::factory(3)
                ->for(User::factory())
                ->create([
                    'type_id' => $type->id,
                ]);

            foreach ($exhibitions_created as $exh) {
                $exhibitions[] = $exh;
            }
        }
        //Each exhibition has 3 comments
        foreach ($exhibitions as $exhibition) {
            Comment::factory(3)
                ->for(User::factory())
                ->create([
                    'exhibition_id' => $exhibition->id,
                ]);
        }

    }
}
