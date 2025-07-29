<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $faker = \Faker\Factory::create();

    for ($i = 0; $i < 20; $i++) {
        Blog::create([
            'category_id' => rand(1, 7),
            'author_id' => 1,
            'title' => $faker->sentence(6),
            'slug' => $faker->slug,
            'excerpt' => $faker->paragraph(2),
            'content' => $faker->paragraphs(10, true),
            'image' => 'img/blog/main-blog/m-blog-'.rand(1,5).'.jpg',
            'views' => rand(100, 5000)
        ]);
    }
}
}
