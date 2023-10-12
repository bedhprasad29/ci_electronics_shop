<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\Category;


class CategorySeeder extends Seeder
{
    public function run()
    {
        $category = new Category;
        $categories = ['Mobiles', 'Televisions', 'Refrigerator', 'Laptops'];

        foreach ($categories as $c)
        {
            $category->save(
                [
                    'name'          =>    $c,
                    'status'        =>    'A',
                    'created_at'    =>    Time::now(),
                    'created_by'    =>    random_int(1,2),
                    'updated_at'    =>    Time::now(),
                    'updated_by'    =>    random_int(1,2)
                ]
            );
        }
    }
}
