<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Menu extends Migration
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
                'constraint' => 65
            ],
            'uri_path' => [
                'type' => 'VARCHAR',
                'constraint' => 65
            ],
            'display_order' => [
                'type' => 'INT',
                'constraint' => 11
            ],
            'main_menu' => [
                'type'         => 'ENUM',
                'constraint'   => ['Y', 'N'],
                'default'      => 'Y',
            ],
            'status' => [
                'type'         => 'ENUM',
                'constraint'   => ['A', 'I'],
                'default'      => 'A',
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
        $this->forge->addForeignKey('created_by', 'users', 'id');
        $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('menus');
    }

    public function down()
    {
        $this->forge->dropTable('menus');
    }
}
