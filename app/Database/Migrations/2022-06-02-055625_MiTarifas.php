<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiTarifas extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tarifa'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'codigo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'descripcion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'tarifa'       => [
                'type'       => 'BIGINT',
                'constraint' => '100',
            ]
        ]);
        $this->forge->addKey('id_tarifa', true);
        $this->forge->createTable('t_tarifas');
    }

    public function down()
    {
        $this->forge->dropTable('t_tarifas');
    }
}
