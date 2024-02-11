<?php

namespace App\Models;

use CodeIgniter\Model;

class MTarifas extends Model
{
    protected $table            = 't_tarifas';
    protected $primaryKey       = 'id_tarifa';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = ['codigo','descripcion','tarifa'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getTarifa($data){
        $tarifa = $this->db->table('t_tarifas');
        $tarifa->where($data);
        return $tarifa->get()->getResultArray();
    }

    public function getTarifas(){
        $tarifas = $this->db->table('t_tarifas');
        return $tarifas->get()->getResultArray();
    }

    public function isertTarifas($data){
        $tarifa = $this->db->table('t_tarifas');
        $tarifa->insertBatch($data);
        return $tarifa->get()->getResultArray();
    }



}
