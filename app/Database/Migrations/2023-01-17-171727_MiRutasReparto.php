<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiRutasReparto extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_ruta'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'fecha'          => [
                'type'           => 'DATETIME',
            ],
            'numero_cc'=>[
                'type'       => 'INT',
                'constraint' => 10,        
            ],
            'nombre' =>[
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'direccion' =>[
                'type' => 'VARCHAR',
                'constraint' => 30,
            ],
            'barrio' =>[
                'type' => 'VARCHAR',
                'constraint' => 30
            ],
            'hora_llegada'       => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'hora_recogida'       => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'ruta' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'consolidado' => [
                'type' => 'VARCHAR',
                'constraint' => 5
            ],
            'movil'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'placa'       => [
                'type'       => 'VARCHAR',
                'constraint' => '6',
            ],
            'conductor'       => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'avantel'       => [
                'type'       => 'VARCHAR',
                'constraint' => '10',
            ],
            'documento' =>[
                'type' => 'VARCHAR',
                'constraint' => '10',  
            ],
            'confirmacion' =>[
                'type' => 'INT',
                'constraint' => '1',
                'default' => null  
            ],
            'novedades' =>[
                'type' => 'VARCHAR',
                'constraint' => '100',  
            ],
            'abordo' =>[
                'type' => 'INT',
                'constraint' => '1',
                'default' => null  
            ],
        ]);
        $this->forge->addKey('id_ruta', true);
        $this->forge->createTable('t_rutas_reparto');
    }

    public function down()
    {
        $this->forge->dropTable('t_rutas_reparto');
    }
}
