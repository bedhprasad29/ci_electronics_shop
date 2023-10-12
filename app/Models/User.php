<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['username', 'email', 'password', 'role_id', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules  = [
        'username'          => 'required|is_unique[users.username,id,{id}]|regex_match[/^\S*$/]|max_length[65]',
        'email'             => 'required|min_length[6]|max_length[65]|valid_email|is_unique[users.email,id,{id}]',
        'password'          => 'required|min_length[6]|max_length[255]',
        'role_id'           => 'required|numeric',
    ];

    protected $selectAllUserData = 'users.id, users.username, users.email, r.id as role_id, r.name as role_name, up.dob, up.mobile, up.state, up.address, up.pincode';

    public function findUserByEmailAddress(string $emailAddress)
    {
        $user = $this
            ->asArray()
            ->where(['email' => $emailAddress])
            ->first();

        if (!$user) 
            throw new Exception('User does not exist for specified email address');

        return $user;
    }

    public function getUserAll()
    {
        $roleId = session('user_data')['role_id'];
        
        $db = db_connect();
        $builder = $this->db->table("users");
        $builder->select($this->selectAllUserData);
        $builder->join('roles r', 'r.id = users.role_id', 'left');
        $builder->join('user_personals up', 'up.user_id = users.id', 'left');

        if($roleId == 1) {
            $builder->whereIn('users.role_id', [2,3,4]);
        }
        if($roleId == 2) {
            $builder->whereIn('users.role_id', [3,4]);
        }
        if($roleId == 3) {
            $builder->whereIn('users.role_id', [4]);
        }

        return $builder->get()->getResult();
    }

    public function getUserOne($id)
    {
        $db = db_connect();
        $builder = $this->db->table("users");
        $builder->select($this->selectAllUserData);
        $builder->join('roles r', 'r.id = users.role_id', 'left');
        $builder->join('user_personals up', 'up.user_id = users.id', 'left');
        $builder->where('users.id', $id);
        return $builder->get()->getRow();
    }
}
