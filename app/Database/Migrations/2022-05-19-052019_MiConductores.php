<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiConductores extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_conductor'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_movil' =>[
                'type' => 'INT',
                'constraint' => 5
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'nombre'       => [
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
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id_conductor', true);
        $this->forge->createTable('t_conductores');
    }

    public function down()
    {
        $this->forge->dropTable('t_conductores');
    }
}
