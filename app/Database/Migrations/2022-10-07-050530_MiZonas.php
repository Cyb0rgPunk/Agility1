<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiZonas extends Migration
{
    //Las migraciones tienen dos metodos Up y Down
    public function up()
    {
        $this->forge->addField([
            'id_sub_zona'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_zona' => [
                'type' => 'INT',
                'constraint'    => 5,
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
        $this->forge->addKey('id_sub_zona', true);
        $this->forge->createTable('t_sub_zonas');
    }

    public function down()
    {
        $this->forge->dropTable('t_sub_zonas');
    }
}
