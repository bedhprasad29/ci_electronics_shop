<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = new User;
        $faker = \Faker\Factory::create();
        
        $user->save(
            [
                'username'      =>    'admin',
                'email'         =>    'admin@gmail.com',
                'password'      =>    password_hash('123456', PASSWORD_BCRYPT), 
                'role_id'       =>    '1',
                'created_at'    =>    Time::now(),
                'created_by'    =>    1,
                'updated_at'    =>    Time::now(),
                'updated_by'    =>    1
            ]
        );

        for($i = 0; $i < 10; $i++)
        {
            $user->save(
                [
                    'username'      =>    $faker->username,
                    'email'         =>    $faker->email,
                    'password'      =>    password_hash('123456', PASSWORD_BCRYPT), 
                    'role_id'       =>    $faker->numberBetween(1,4),
                    'created_at'    =>    Time::now(),
                    'created_by'    =>    1,
                    'updated_at'    =>    Time::now(),
                    'updated_by'    =>    1
                ]
            );
        }
    }
}
