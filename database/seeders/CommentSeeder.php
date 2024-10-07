<?php

namespace Database\Seeders;
use App\Models\Comment;

use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comment::create([
        'user_id'=>5,
        'product_id' =>1,
        'comment' => 'AAAAAAAAAAAAAAAA'
        ]);
        Comment::create([
        'user_id'=>7,
        'product_id' => 2,
        'comment' => 'aaaaaaaaaaaaaaaaaaa'
        ]);
        Comment::create([
        'user_id'=>9,
        'product_id' => 5,
        'comment' => 'asasasasasa'
        ]);
        Comment::create([
        'user_id'=>10,
        'product_id' => 7,
        'comment' => 'abavavavava'
        ]);
        Comment::create([
        'user_id'=>7,
        'product_id' => 8,
        'comment' => 'ABABABBbbbbbbbbbbbb'
        ]);
        Comment::create([
        'user_id'=>9,
        'product_id' => 2,
        'comment' => 'lf;sdfkdasl;fkad'
        ]);
        Comment::create([
        'user_id'=>5,
        'product_id' => 5,
        'comment' => 'dddaaadddaaa'
        ]);
        Comment::create([
        'user_id'=>5,
        'product_id' => 2,
        'comment' => '1231354'
        ]);
        Comment::create([
        'user_id'=>10,
        'product_id' => 2,
        'comment' => 'worked for me'
        ]);
        Comment::create([
        'user_id'=>10,
        'product_id' => 1,
        'comment' => 'very Good'
        ]);

    }
}

