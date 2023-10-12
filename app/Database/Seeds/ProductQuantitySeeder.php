<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use CodeIgniter\I18n\Time;
use App\Models\ProductQuantity;

class ProductQuantitySeeder extends Seeder
{
    public function run()
    {  
        $product_quantity = new ProductQuantity;

        for($i = 0; $i < 16; $i++)
        {
            $product_quantity->save(
                [
                    'product_id'    =>    random_int(1,16),
                    'quantities'    =>    random_int(1,8),
                    'created_at'    =>    Time::now(),
                    'created_by'    =>    random_int(1,2),
                    'updated_at'    =>    Time::now(),
                    'updated_by'    =>    random_int(1,2)
                ]
            );
        }
    }
}
