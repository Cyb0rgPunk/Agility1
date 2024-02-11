<?php

namespace App\Models;

use CodeIgniter\Model;

class MZonas extends Model
{
    protected $table            = 't_sub_zonas';
    protected $primaryKey       = 'id_sub_zona';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = ['id_zona','nombre','descripcion'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function get($data){
        $table = $this->db->table('t_sub_zonas');
        $table->where($data);
        return $tarifa->get()->getResultArray();
    }

    public function getAll(){
        $table = $this->db->table('t_sub_zonas');
        return $table->get()->getResultArray();
    }

    public function isertAll($data){
        $table = $this->db->table('t_sub_zonas');
        $table->insertBatch($data);
        return $table->get()->getResultArray();
    }


}
