<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        User::truncate();


        $user = User::factory()->create([
            'name' => 'Joshua',
            'phone_number' => '61416628308'
        ]);

        $userT = User::factory()->create([
            'name' => 'Thomas',
            'phone_number' => '61416628308'
        ]);

        $math = Category::factory()->create([
            "name" => "Math",
            "slug" => "math",
        ]);
    
        $dataScience = Category::factory()->create([
            "name" => "Data Science",
            "slug" => "data_science",
        ]);
    
        $computerScience = Category::factory()->create([
            "name" => "Computer Science",
            "slug" => "computer_science",
        ]);
    
        $softwareEngineering = Category::factory()->create([
            "name" => "Software Engineering",
            "slug" => "software_engineering",
        ]);
    
        Post::factory(5)->create([
            'user_id' => $user->id,
            "category_id" => $dataScience->id,
        ]);

        Post::factory(5)->create([
            'user_id' => $user->id,
            "category_id" => $math->id,
        ]);
        Post::factory(5)->create([
            'user_id' => $user->id,
            "category_id" => $computerScience->id,
        ]);
        Post::factory(5)->create([
            'user_id' => $userT->id,
            "category_id" => $dataScience->id,
        ]);
        Post::factory(5)->create([
            'user_id' => $userT->id,
            "category_id" => $softwareEngineering->id,
        ]);
    
        // Post::factory(5)->state([
        //     "category_id" => $dataScience->id,
        // ])->create([
        //     "user_id" => $user->id,
        // ]);
    
        // Post::factory(5)->state([
        //     "category_id" => $dataScience->id,
        // ])->create([
        //     "user_id" => $user->id,
        // ]);
    
        // Post::factory(5)->state([
        //     "category_id" => $dataScience->id,
        // ])->create([
        //     "user_id" => $user->id,
        // ]);

        // Post::factory(5)->state([
        //     "category_id" => $dataScience->id,
        // ])->create([
        //     "user_id" => $user->id,
        // ]);


    }
}
