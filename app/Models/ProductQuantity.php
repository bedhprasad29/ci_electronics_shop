<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductQuantity extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'product_quantities';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['product_id', 'quantities', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [   
        'product_id' => 'required',
        'quantities' => 'required|numeric'
    ];
}
