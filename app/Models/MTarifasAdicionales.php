<?php

namespace App\Models;

use CodeIgniter\Model;

class MTarifasAdicionales extends Model
{
    protected $table            = 't_tarifas_adicionales';
    protected $primaryKey       = 'id_tarifa_adicional';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = [
        'id_tarifa',
        'id_solicitud',
        'solicita',
        'motivo',
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getTarifas_adicionales($data){
        $tarifa = $this->db->table('t_tarifas');
        $tarifa->where($data);
        return $tarifa->get()->getResultArray();
    }
}
