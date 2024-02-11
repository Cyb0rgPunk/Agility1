<?php

namespace App\Models;

use CodeIgniter\Model;

class MCentroCosto extends Model
{
    protected $table            = 't_centro_costos';
    protected $primaryKey       = 'id_cc';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = ['codigo','nombre'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

   public function getCC(){
    $user = $this->db->table('t_centro_costos')->orderBy('nombre','ASC');
    return $user->get()->getResultArray();
}
}
