<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiUser extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_user'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'user'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'identification'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'phone'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'group' => [
                'type' => 'INT',
                'constraint' => '12',
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'barrio' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'zone' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_operation' => [
                'type' => 'INT',
                'constraint' => '5',
            ]
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->createTable('t_users');
    }

    public function down()
    {
        $this->forge->dropTable('t_users');
    }
}
