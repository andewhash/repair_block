<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Str;
class BlogCategorySeeder extends Seeder
{


    public function run()
    {
        $categories = [
            'Technology', 'Lifestyle', 'Fashion', 'Art', 
            'Food', 'Architecture', 'Adventure'
        ];
    
        foreach ($categories as $category) {
            BlogCategory::create([
                'name' => $category,
                'slug' => Str::slug($category)
            ]);
        }
    }
}
