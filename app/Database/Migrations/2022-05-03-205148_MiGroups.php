<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiGroups extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_group'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'description'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id_group', true);
        $this->forge->createTable('t_groups');
    }

    public function down()
    {
        $this->forge->dropTable('t_groups');
    }
}
