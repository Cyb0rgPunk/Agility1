<?php

namespace App\Models;

use CodeIgniter\Model;

class MSolicitudes extends Model
{
    protected $table            = 't_solicitudes';
    protected $primaryKey       = 'id_solicitud';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = 
    [
        'id_solicitud',
        'id_pasajero',
        'id_movil',
        'id_cliente',
        'id_operacion',
        'id_ciudad',
        'origen',
        'destino',
        'id_zona_origen',
        'id_zona_destino',
        'fecha_hora',
        'id_tipo_servicio',
        'observacion',
        'estado_asignado',
        'cantidad_personas',
        'evento',
        'id_usuario_asigna',
        'id_usuario_solicita',
        'estado_asigando',
        'id_conductor',
        'centro_costo',
        'cancelada',
        'fecha_hora_solicitud'
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getSolicitud($data){
        $movil = $this->db->table('t_solicitudes');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getSolicitudDetalles($data){
        $movil = $this->db->table('t_solicitudes');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getSolicitudes(){
        $movil = $this->db->table('t_solicitudes');
        return $movil->get()->getResultArray();
    }

    public function getHistorialUsuario($data){

        //dd($data);
        $query = "SELECT * FROM t_solicitudes s INNER JOIN t_pasajeros p ON s.id_pasajero = p.id_pasajero WHERE s.id_pasajero = ".$data[1]." OR s.id_usuario_solicita = ".$data[0].";";
       
       //dd($query);
        $historial = $this->db->query($query);
       //dd($historial->getResultArray());
        
        return $historial->getResultArray();
    }


}
