<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $product = new Product;
        $categories = [
            ['Samsung', 'Apple', 'Huawei', 'Nokia'],
            ['Samsung TV', 'Xiaomi Mi TV', 'LG TV', 'Sony TV'],
            ['GE', 'LG', 'Whirlpool', 'Panasonic'],
            ['Acer', 'Asus', 'Dell', 'HP']
        ];

        foreach ($categories as  $key => $category)
        {
            $cat = $key + 1;
            foreach($category as $p)
            {
                $product->save(
                    [
                        'name'          => $p, 
                        'category_id'   => $cat, 
                        'description'   => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.', 
                        'price'         => random_int(1000,10000),
                        'status'        => 'A',
                        'created_at'    => Time::now(),
                        'created_by'    => random_int(1,3),
                        'updated_at'    => Time::now(),
                        'updated_by'    => random_int(1,3)
                    ]
                );
            }
        }  
    }
}
