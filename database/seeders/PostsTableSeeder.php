<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for ($i=0; $i < 15; $i++) {
            Post::create([
                'user_id'           =>  User::inRandomOrder()->first()->id,
                'category_id'       =>  Category::inRandomOrder()->first()->id,
                'title'             =>  $faker->sentence(4),
                'slug'              =>  $faker->unique()->slug,
                'body'              =>  $faker->paragraph(),
                'image'             =>  sprintf('%02d', $i).'.jpg',
            ]);
        }
    }
}
