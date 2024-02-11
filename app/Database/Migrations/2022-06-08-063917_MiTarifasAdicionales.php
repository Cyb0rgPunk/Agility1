<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiTarifasAdicionales extends Migration
{
    public function up()
    {    
        $this->forge->addField([
            'id_tarifa_adicional'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_tarifa' =>[
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_solicitud' =>[
                'type' => 'INT',
                'constraint' => 5
            ],
            'solicita' =>[
                'type' => 'VARCHAR',
                'constraint' => 200
            ],
            'motivo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
                'null' => true
            ]
        ]);
        $this->forge->addKey('id_tarifa_adicional', true);
        $this->forge->createTable('t_tarifas_adicionales');
    }

    public function down()
    {
        $this->forge->dropTable('t_tarifas_adicionales');
    }
}
