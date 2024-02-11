<?php

namespace App\Models;

use CodeIgniter\Model;

class MMovil extends Model
{
    protected $table            = 't_moviles';
    protected $primaryKey       = 'id_movil';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = 
    [
        'id_propietario',
        'movil',
        'placa',
        'tipo_vehiculo',
        'estado',
        'capacidad',
        'tipo_flota',
        'marca',
        'empresa',
        'observaciones',
        'modelo',
        'celular',
        'name',
        'identification',
        'password'
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getMovil($data){
        $movil = $this->db->table('t_moviles');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getMoviles(){
        $movil = $this->db->table('t_moviles');
        return $movil->get()->getResultArray();
    }





}
