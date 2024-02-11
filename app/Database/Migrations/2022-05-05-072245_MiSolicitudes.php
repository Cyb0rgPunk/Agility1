<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiSolicitudes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_solicitud'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_pasajero'          => [
                'type'           => 'INT',
                'constraint'     => 5,
            ],
            'estado_asignado'=>[
                'type'       => 'INT',
                'constraint' => 1,
                'null'       => true,
                'default'    => 0           
            ],
            'id_movil' =>[
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_conductor' =>[
                'type' => 'INT',
                'constraint' => 5,
                'after' => 'id_movil'
            ],
            'id_cliente' =>[
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_operacion'       => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_ciudad'       => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_usuario_asigna' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'id_usuario_solicita' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'origen'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'destino'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'id_zona_origen'       => [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'id_zona_destino'       => [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'fecha_hora' =>[
                'type' => 'DATETIME',  
            ],
            'fecha_hora_solicitud' =>[
                'type' => 'DATETIME',  
            ],
            'id_tipo_servicio' =>[
                'type' => 'int',
                'constraint' => '5'   
            ],
            'observacion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '5000',
            ],
            'centro_costo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cantidad_personas'       => [
                'type'       => 'INT',
                'constraint' => '3',
            ],
            'evento'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cancelada' => [
                'type'  => 'BOOLEAN',
            ]
        ]);
        $this->forge->addKey('id_solicitud', true);
        $this->forge->createTable('t_solicitudes');
    }

    public function down()
    {
        $this->forge->dropTable('t_solicitudes');
    }
}
