<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserPersonal extends Migration
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
            'user_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'dob' => [
                'type' => 'DATE'
            ],
            'mobile' => [
                'type' => 'VARCHAR',
                'constraint' => 10
            ],
            'state' => [
                'type' => 'VARCHAR',
                'constraint' => 55
            ],
            'address' => [
                'type' => 'VARCHAR',
                'constraint' => 255
            ],
            'pincode' => [
                'type' => 'INT',
                'constraint' => 6
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
        $this->forge->addForeignKey('user_id', 'users', 'id');
        // $this->forge->addForeignKey('created_by', 'users', 'id');
        // $this->forge->addForeignKey('updated_by', 'users', 'id');
        $this->forge->createTable('user_personals');
    }

    public function down()
    {
        $this->forge->dropTable('user_personals');
    }
}
