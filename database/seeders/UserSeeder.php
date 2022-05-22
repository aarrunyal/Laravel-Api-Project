<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            "first_name"=>"Xyz",
            "middle_name"=>"Xyz",
            "last_name"=>"Xyz",
            "email"=>"Xyz@gmail.com",
            "password"=>bcrypt(12345)
        ]);
    }
}
