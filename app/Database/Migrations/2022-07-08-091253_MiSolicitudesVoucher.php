<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiSolicitudesVoucher extends Migration
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
            'item'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'voucher'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'radicado'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'trayecto'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'motivo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'emp'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'ceco'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'viaje'       => [
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
        $this->forge->createTable('t_solicitudes_voucher');
    }

    public function down()
    {
        $this->forge->dropTable('t_solicitudes_voucher');
    }
}
