<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MiPasajeros extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pasajero'          => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'id_cliente' => [
                'type' => 'INT',
                'constraint' => '12',
            ],
            'id_user_registro' => [
                'type' => 'INT',
                'constraint' => '5',
            ],
            'tipo_documento' => [
                'type' => 'INT',
                'constraint' => '12',
            ],
            'documento'       => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'primer_nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'segundo_nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'primer_apellido'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'segundo_apellido'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'celular'       =>[
                'type' => 'VARCHAR',
                'constraint' => '10',
            ],
            'centro_costo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cargo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sucursal'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'area'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'observaciones'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'activo' =>[
                'type' => 'BINARY',
                'constrain' => 1,
                'null' => true,
                'default' => 1
            ],
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'password'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'group' => [
                'type' => 'INT',
                'constraint' => '12',
            ],
        ]);
        $this->forge->addKey('id_pasajero', true);
        $this->forge->createTable('t_pasajeros');
    }

    public function down()
    {
        $this->forge->dropTable('t_pasajeros');
    }
}
