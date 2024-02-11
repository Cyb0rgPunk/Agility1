<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiZonasPrimarias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_zona'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'descripcion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ]
        ]);
        $this->forge->addKey('id_zona', true);
        $this->forge->createTable('t_zonas');
    }

    public function down()
    {
        $this->forge->dropTable('t_zonas');
    }
}
