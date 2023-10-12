<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $role = new Role;
        $roles = ['Admin', 'Manager', 'Sr. Employee', 'Employee'];

        foreach ($roles as $r)
        {
            $role->save(
                [
                    'name'          =>    $r,
                    'status'        =>    'A',
                    'created_at'    =>    Time::now(),
                    'created_by'    =>    1,
                    'updated_at'    =>    Time::now(),
                    'updated_by'    =>    1
                ]
            );
        }
    }
}
