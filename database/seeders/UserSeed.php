<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 20; $i++){
            User::create([
                'name' => "UserName".$i,
                'last_name' => "Lastname".$i,
                'email' => "user$i@test.com",
                'username' => "user$i",
                'password' => md5("user$i"),
                'role' => "Non admin"
            ]);
        }
    }
}
