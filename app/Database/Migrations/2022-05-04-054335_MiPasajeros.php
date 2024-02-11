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
            'id_nacional' => [
                'type' => 'INT',
                'constraint' => '20',
            ],
            'region'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'pais'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'ciudad'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'organizacion'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'empresa'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'c_level'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'viseprescidente'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'direccion_general'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'direccion'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'gerencia'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'jefactura'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'area'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],            
            'centro_costo'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],            
            'nombre_centro_costo'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'codigo_empleado'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],            
            'user_sys'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],                        
            'codigo_rps'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],            
            'id_nacional'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],            
            'tipo_documento'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],                        
            'fecha_nacimiento'    => [
                'type'       => 'DATE',    
            ],            
            'genero'    => [
                'type'       => 'VARCHAR',
                'constraint' => '30',
            ],
            'primer_apellido'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'segundo_apellido'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],                       
            'primer_nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'segundo_nombre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'nombre_completo' => [
                'type' => 'VARCHAR',
                'constraint' => '200'
            ],
            'posicion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'codigo_posicion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'grupo_personal'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'area_personal'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'trabajo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'auxilio_combustible'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'correo'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'direccion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'barrio'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'celular'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'operacion'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'zona_ruta'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'habilitado'       => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'group' => [
                'type' => 'INT',
                'constraint' => '12',
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
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
