<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Products extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => false
            ],
            'description' => [
                'type' => 'TEXT',
                'constraint' => 255,
                'null' => false
            ],
            'price' => [
                'type' => 'DECIMAL(10,2)',
                'null' => false
            ],
            'status'      => [
                'type'           => 'ENUM',
                'constraint'     => ['A', 'I'],
                'default'        => 'A',
                'null' => false
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'created_by' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'updated_by' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'categories', 'id');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('products');
    }

    public function down()
    {
        $this->forge->dropTable('products');
    }
}
