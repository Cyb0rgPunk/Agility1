<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiMovil extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_movil'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'name'       => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
            ],
            'identification'       => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'movil' =>[
                'type' => 'INT',
                'constraint' => '4'
            ],
            'placa'       => [
                'type'       => 'VARCHAR',
                'constraint' => '7',
            ],
            'celular'       =>[
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tipo_vehiculo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'estado'       => [
                'type'       => 'INT',
                'constraint' => '10',
            ],
            'capacidad'       => [
                'type'       => 'INT',
                'constraint' => '3',
            ],
            'tipo_flota'       => [
                'type'       => 'INT',
                'constraint' => '4',
            ],
            'marca' =>[
                'type' => 'VARCHAR',
                'constraint' => '50'   
            ],
            'empresa' =>[
                'type' => 'VARCHAR',
                'constraint' => '50'   
            ],
            'observaciones' =>[
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'modelo' =>[
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password'      => [
                'type' => 'VARCHAR',
                'constraint' => '250',
            ]            
        ]);
        $this->forge->addKey('id_movil', true);
        $this->forge->createTable('t_moviles');
    }

    public function down()
    {
        $this->forge->dropTable('t_moviles');
    }
}
