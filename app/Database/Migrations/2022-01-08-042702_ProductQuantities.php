<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductQuantities extends Migration
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
            'product_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true
            ],
            'quantities' => [
                'type' => 'INT',
                'constraint' => 11,
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
        $this->forge->addForeignKey('product_id', 'products', 'id');
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('product_quantities');
    }

    public function down()
    {
        $this->forge->dropTable('product_quantities');
    }
}
