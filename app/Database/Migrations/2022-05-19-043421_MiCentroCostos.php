<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiCentroCostos extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_cc'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'codigo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ]
        ]);
        $this->forge->addKey('id_cc', true);
        $this->forge->createTable('t_centro_costos');
    }

    public function down()
    {
        $this->forge->dropTable('t_centro_costos');
    }
}
