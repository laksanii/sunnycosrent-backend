<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Costume;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $categories = [
            "genshin impact",
            "love live",
            "vtuber",
            "anime",
            "game"
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category
            ]);
        }

        // $faker = Faker::create();

        // $costumes = Costume::all();

        // foreach ($costumes as $costume) {
        //     for ($i = 0; $i < 3; $i++) {
        //         DB::table('costume_picts')->insert([
        //             'path' => $faker->imageUrl(640, 480, 'animals', true),
        //             'costume_id' => $costume->id,
        //         ]);
        //     }
        // }
    }
}