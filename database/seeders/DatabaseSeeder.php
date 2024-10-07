<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        //$this->call(UserSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(AdminSeeder::class);
        //$this->call(ReviewSeeder::class);
        //$this->call(ProductSeeder::class);
        //$this->call(CommentSeeder::class);
    }
}
