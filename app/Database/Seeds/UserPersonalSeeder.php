<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\UserPersonal;

class UserPersonalSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create();

        $db = db_connect();

        for($i = 0; $i < 10; $i++)
        {
            $db->table('user_personals')->insert([
                'user_id'       =>    $i + 1,
                'dob'           =>    '1990-01-01', 
                'mobile'        =>    $faker->numerify('##########'), 
                'state'         =>    'Karnataka',
                'address'       =>    $faker->address,
                'pincode'       =>    $faker->numerify('#######'),
                'created_at'    =>    Time::now(),
                'created_by'    =>    $faker->numberBetween(1,2),
                'updated_at'    =>    Time::now(),
                'updated_by'    =>    $faker->numberBetween(1,2)
            ]);
        }
    }
}
