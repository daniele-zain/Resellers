<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::create([
            'id'=>5,
            'name'=>'Rasheed',
            'last_name'=>'Sh',
            'phone'=>'056454656',
            'address'=>'sdfosdlfjsdklfj',
            'email'=>'Rasheedshuk@ff.ssd',
            'password'=>'asfhea544',
            'current_rating'=>3.8,
            'number_of_sold_items'=>2
        ]);
        User::create([
            'id'=>7,
            'name'=>'Tammam',
            'last_name'=>'monther',
            'phone'=>'0546565645224',
            'address'=>'dsakdljasdfsadfsddsadosdlfjsdklfj',
            'email'=>'Tammammo@mai.tmm',
            'password'=>'tammam213',
            'current_rating'=>4.2,
            'number_of_sold_items'=>4
        ]);
        User::create([
            'id'=>9,
            'name'=>'Daniele',
            'last_name'=>'Zain',
            'phone'=>'05465610000',
            'address'=>'dsakdljassaSA;DLASdfosdlfjsdklfj',
            'email'=>'danielzai@dan.dz',
            'password'=>'100200300',
            'current_rating'=>3.0,
            'number_of_sold_items'=>2
        ]);
        User::create([
            'id'=>10,
            'name'=>'kenan',
            'last_name'=>'Shtay',
            'phone'=>'0989898',
            'address'=>'jsdklfj',
            'email'=>'kkkkknnnnn@knsh.dd',
            'password'=>'10203040',
            'current_rating'=>4.0,
            'number_of_sold_items'=>6
        ]);
    }
}
