<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Categories extends Migration
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
                'type'       => 'VARCHAR',
                'constraint' => 100,
                'null'       => false
            ],
            'status'      => [
                'type'       => 'ENUM',
                'constraint' => ['A', 'I'],
                'default'    => 'A',
                'null'       => false
            ],
            'created_at' => [
                'type'  => 'timestamp',
                'null'  => true
            ],
            'created_by' => [
                'type'          => 'int',
                'constraint'    => 11,
                'unsigned'      => true
            ],
            'updated_at' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'updated_by' => [
                'type'       => 'int',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('categories');
    }

    public function down()
    {
        $this->forge->dropTable('categories');
    }
}
