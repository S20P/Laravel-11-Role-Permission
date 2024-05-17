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
                "name" => "Latest Blog", "description" => "Latest Blog"
            ],
            [
                "name" => "Trending Blog", "description" => "Trending Blog"
            ],
            [
                "name" => "Oldest Blog", "description" => "Oldest Blog"
            ]          
         ];

         foreach ($categories as $category) {
            Category::create(['name' => $category['name'],'description' => $category['description'] ]);
          }

    }
}
