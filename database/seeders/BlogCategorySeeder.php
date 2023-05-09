<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BlogCategory::insert([
            'blog_id' => '10',
            'category_id' => '1',
            'created_at' => now()
        ]);

        BlogCategory::insert([  
            'blog_id' => '10',
            'category_id' => '2',
            'created_at' => now()
        ]);

        BlogCategory::insert([
            'blog_id' => '10',
            'category_id' => '3',
            'created_at' => now()
        ]);

        BlogCategory::insert([
            'blog_id' => '8',
            'category_id' => '2',
            'created_at' => now()
        ]);

        BlogCategory::insert([
            'blog_id' => '8',
            'category_id' => '3',
            'created_at' => now()
        ]);

        BlogCategory::insert([
            'blog_id' => '3',
            'category_id' => '2',
            'created_at' => now()
        ]);
    }
}
