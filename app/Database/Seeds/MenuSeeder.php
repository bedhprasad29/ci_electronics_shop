<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\Menu;
use App\Models\MenuPermission;

class MenuSeeder extends Seeder
{
    public function run()
    {
        $menu = new Menu;
        
        $menus = [
            'Product'   => 'products',
            'Category'  => 'categories',
            'Role'      => 'roles',
            'Employee'  => 'users',
            'Profile'   => 'profile'
        ];

        $count = 1;
        foreach ($menus as $name => $uriPath)
        {
            if ($name == 'Profile') {
                $mainMenu = 'N';
            } else {
                $mainMenu = 'Y';
            }
            $menu->save(
                [
                    'name'          =>  $name, 
                    'uri_path'      =>  $uriPath, 
                    'display_order' =>  $count,
                    'main_menu'     =>  $mainMenu,
                    'created_at'    =>  Time::now(),
                    'created_by'    =>  1,
                    'updated_at'    =>  Time::now(),
                    'updated_by'    =>  1
                ]
            );
            $count++;
        }

        // create menu permission for different role
        $permission = new MenuPermission;
        
        $permissionArr = [
            '1' => [1, 2, 3, 4, 5],
            '2' => [1, 2, 4, 5],
            '3' => [1, 4, 5],
            '4' => [5]
        ];

        foreach ($permissionArr as $role_id => $menus)
        {
            foreach ($menus as $m)
            {
                $permission->save(
                    [
                        'menu_id'   =>  $m,
                        'role_id'   =>  $role_id
                    ]
                );
            }
        }
    }
}
