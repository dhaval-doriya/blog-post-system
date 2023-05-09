<?php

namespace Database\Seeders;

use App\Models\Blog;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Blog::create([
            'name' => 'this is blog title',
            'image' => 'test.png',
            'description' => ' <h1> testting</h1>',
            'slug' => 'test-test-title-of-blog',
    ]);
    }
}
