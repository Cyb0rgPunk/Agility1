<?php

namespace App\Models;

use CodeIgniter\Model;

class MConductor extends Model
{
    protected $table            = 't_conductores';
    protected $primaryKey       = 'id_conductor';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = [
        'id_movil',
        'email',
        'nombre',
        'identification',
        'phone',
        'password'
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';


    public function getConductor($data){
        $movil = $this->db->table('t_conductores');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getConductores(){
        $movil = $this->db->table('t_conductores');
        return $movil->get()->getResultArray();
    }
}
