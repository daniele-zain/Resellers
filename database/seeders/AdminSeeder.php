<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'id'=>1,
            'email' => env('SEEDER_ADMIN_EMAIL', 'admin@gmail.com'),
            'password' => Hash::make((env('SEEDER_ADMIN_PASSWORD', 'admin')))
        ]);
    }
}
