<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'status', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules  = [
        'name'  => 'required|max_length[100]',
        'status'=> 'required'
    ];
}
