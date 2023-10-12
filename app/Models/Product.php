<?php

namespace App\Models;

use CodeIgniter\Model;

class Product extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'products';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['name', 'category_id', 'image', 'description' , 'price', 'status', 'created_by', 'updated_by'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        
        'name' => 'required|is_unique[products.name,id,{id}]|max_length[255]',
        'category_id' => 'required',
        'description' => 'required|max_length[255]',
        'price' => 'required|decimal',
        'status' => 'required'
    ];

    protected $selectAllProductData = 'products.id, products.name, products.description, products.price, products.status, c.id as category_id, c.name as category_name';

    public function getProductAll()
    {
        $db = db_connect();
        $builder = $this->db->table("products");
        $builder->select($this->selectAllProductData);
        $builder->join('categories c', 'products.category_id = c.id', 'left');
        return $builder->get()->getResult();
    }

    public function getProductOne($id)
    {
        $db = db_connect();
        $builder = $this->db->table("products");
        $builder->select($this->selectAllProductData);
        $builder->join('categories c', 'products.category_id = c.id', 'left');
        $builder->where('products.id', $id);
        return $builder->get()->getRow();
    }
}
