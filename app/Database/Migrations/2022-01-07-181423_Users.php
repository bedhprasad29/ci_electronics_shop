<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
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
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 65
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => 65
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'timestamp',
                'null' => true
            ],
            'created_by' => [
                'type' => 'int',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true
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
        $this->forge->addForeignKey('role_id', 'roles', 'id');
        $this->forge->createTable('users');

    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
