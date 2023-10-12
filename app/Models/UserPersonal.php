<?php

namespace App\Models;

use CodeIgniter\Model;

class UserPersonal extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'user_personals';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'dob', 'mobile', 'state', 'address', 'pincode', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules      = [
        'dob'               => 'required|valid_date',
        'mobile'            => 'required|numeric|exact_length[10]',
        'state'             => 'required|alpha|max_length[55]',
        'address'           => 'required|max_length[255]',
        'confirm_password'  => 'required|matches[password]',
        'pincode'           => 'required|numeric|exact_length[6]',
    ];
}
