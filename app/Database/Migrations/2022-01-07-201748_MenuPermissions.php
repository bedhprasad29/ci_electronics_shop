<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MenuPermissions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'menu_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'role_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ]
        ]);
        $this->forge->addForeignKey('menu_id', 'menus', 'id');
        $this->forge->addForeignKey('role_id', 'roles', 'id');
        $this->forge->createTable('menu_permissions');
    }

    public function down()
    {
        $this->forge->dropTable('menu_permissions');
    }
}
