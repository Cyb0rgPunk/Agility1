<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiSolicitudesTripulacion extends Migration
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
            'id_tipo_vehiculo'          => [
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
            'id_tipo_servicio' =>[
                'type' => 'int',
                'constraint' => '5'   
            ],
            'origen'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'destino'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'origen_vuelo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'destino_vuelo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'fecha_hora' =>[
                'type' => 'DATETIME',  
            ],
            'fecha_hora_solicitud' =>[
                'type' => 'DATETIME',  
            ],
            'observacion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '5000',
            ],
            'cantidad_personas'       => [
                'type'       => 'INT',
                'constraint' => '3',
            ],
            'vuelo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'codigo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'it'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'estado_pasajero'=> [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'estado_conductor'=> [
                'type'       => 'INT',
                'constraint' => '5',
            ],
            'cancelada_conductor' => [
                'type'  => 'BOOLEAN',
            ],
            'cancelada_pasajero' => [
                'type'  => 'BOOLEAN',
            ],
            'cancelada_admin' => [
                'type'  => 'BOOLEAN',
            ],
            'fecha_hora_inicio_viaje' =>[
                'type' => 'DATETIME',  
            ],
            'inicio_viaje' => [
                'type'  => 'BOOLEAN',
            ],
            'fecha_hora_fin_viaje' =>[
                'type' => 'DATETIME',  
            ],
            'id_novedad' => [
                'type'  => 'INT',
                'constraint' => '1',
            ],
        ]);
        $this->forge->addKey('id_solicitud', true);
        $this->forge->createTable('t_solicitudes_tripulacion');
    }

    public function down()
    {
        $this->forge->dropTable('t_solicitudes_tripulacion');
    }
}
