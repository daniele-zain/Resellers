<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

         Product::create([
            'id'=>1,
            'name'=>'shirt',
            'product_creator'=>5,
            'description'=>'this is new blue shirt',
            'price'=>25,
            'category_id'=>1,
            'condition'=>'good'
        ]);
         Product::create([
            'id'=>2,
            'name'=>'television',
            'product_creator'=>7,
            'description'=>'this is an old TV ',
            'price'=>150,
            'category_id'=>2,
            'condition'=>'good'
        ]);
         Product::create([
            'id'=>5,
            'name'=>'lamp',
            'product_creator'=>7,
            'description'=>'this is new lamp',
            'price'=>12,
            'category_id'=>1,
            'condition'=>'good'
        ]);
         Product::create([
            'id'=>7,
            'name'=>'chair',
            'product_creator'=>9,
            'description'=>'this is a new chair',
            'price'=>20,
            'category_id'=>2,
            'condition'=>'good'
        ]);
         Product::create([
            'id'=>8,
            'name'=>'shoes',
            'product_creator'=>7,
            'description'=>'these are our new shoes',
            'price'=>7,
            'category_id'=>3,
            'condition'=>'good'
        ]);

    }
}
