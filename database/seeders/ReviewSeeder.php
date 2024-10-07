<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Review::create([
            'reviewer_id'=>5,
            'reviewed_id'=>1,
            'review'=>'Very Thoughtful',
            'rating'=>2.0
        ]);
        Review::create([
            'reviewer_id'=>7,
            'reviewed_id'=>1,
            'review'=>'High quality products',
            'rating'=>2.8

        ]);
        Review::create([
            'reviewer_id'=>10,
            'reviewed_id'=>9,
            'review'=>'unaffordable prices',
            'rating'=>4.0

        ]);
        Review::create([
            'reviewer_id'=>10,
            'reviewed_id'=>1,
            'review'=>'It was a pleasure making business with you ',
            'rating'=>3.9

        ]);

    }
}

