<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                "name" => "Latest Blog", "slug" => "latest-blog", "description" => "Latest Blog"
            ],
            [
                "name" => "Trending Blog", "slug" => "trending-blog", "description" => "Trending Blog"
            ],
            [
                "name" => "Oldest Blog", "slug" => "oldest-blog", "description" => "Oldest Blog"
            ]          
         ];

         foreach ($categories as $category) {
            Category::create(['name' => $category['name'], 'slug' => $category['slug'],'description' => $category['description'] ]);
          }

    }
}
