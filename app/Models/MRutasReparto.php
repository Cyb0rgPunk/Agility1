<?php

namespace App\Models;

use CodeIgniter\Model;

class MRutasReparto extends Model
{
    protected $table            = 't_rutas_reparto';
    protected $primaryKey       = 'id_ruta';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields = ['abordo','novedades','confirmacion','fecha', 'numero_cc', 'nombre', 'direccion', 'barrio', 'hora_llegada', 'hora_recogida', 'ruta', 'consolidado', 'movil', 'placa', 'conductor', 'avantel', 'documento'];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getMovil($data){
        $movil = $this->db->table('t_rutas_reparto');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getRutas(){
        $ruta = $this->db->table('t_rutas_reparto')->groupBy('ruta');
        return $ruta->get()->getResultArray();
    }
}
