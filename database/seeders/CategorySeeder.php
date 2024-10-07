<?php

namespace Database\Seeders;
use App\Models\Category;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
        'id'=>1,
        'name' => 'Electronics'
       ]);
        Category::create([
            'id'=>2,
        'name' => 'Clothing'
       ]);
        Category::create([
            'id'=>3,
        'name' => 'Books'
       ]);
    }
}

