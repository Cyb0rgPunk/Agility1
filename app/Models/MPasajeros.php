<?php

namespace App\Models;

use CodeIgniter\Model;

class MPasajeros extends Model
{
    protected $table            = 't_pasajeros';
    protected $primaryKey       = 'id_pasajero';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = [
        'id_cliente',
        'id_nacional',
        'region',
        'pais',
        'ciudad',
        'organizacion',
        'empresa',
        'c_level',
        'viseprescidente',
        'direccion_general',
        'direccion',
        'gerencia',
        'jefactura',
        'area',
        'centro_costo',
        'nombre_centro_costo',
        'codigo_empleado',
        'user_sys',
        'codigo_rps',
        'id_nacional2',
        'tipo_documento',
        'fecha_nacimiento',
        'genero',
        'primer_apellido',
        'segundo_apellido',
        'primer_nombre',
        'segundo_nombre',
        'nombre_completo',
        'posicion',
        'codigo_posicion',
        'grupo_personal',
        'area_personal',
        'trabajo',
        'auxilio_combustible',
        'correo',
        'direccion',
        'barrio',
        'celular',
        'operacion',
        'zona_ruta',
        'habilitado',
        'group',
        'password'
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getPasajeros(){
        $user = $this->db->table('t_pasajeros');
        return $user->get()->getResultArray();
    }

    public function getPasajerosUser($data){
        $user = $this->db->table('t_pasajeros')->where(['id_user_registro' => $data]);
        return $user->get()->getResultArray();
    }

    public function getPasajero($data){
        $user = $this->db->table('t_pasajeros');
        $user->where($data);
        return $user->get()->getResultArray();
    }
}
