<?php

namespace App\Models;

use CodeIgniter\Model;

class MSolicitudesTripulacion extends Model
{
    protected $table            = 't_solicitudes_tripulacion';
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
        'id_tipo_servicio',
        'id_tipo_vehiculo',
        'origen',
        'destino',
        'fecha_hora',
        'observacion',
        'estado_asignado',
        'cantidad_personas',
        'vuelo',
        'codigo',
        'it',
        'id_usuario_asigna',
        'id_usuario_solicita',
        'estado_asigando',
        'id_conductor',
        'centro_costo',
        'estado_conductor',
        'estado_pasajero',
        'cancelada_pasajero',
        'cancelada_conductor',
        'fecha_hora_solicitud',
        'fecha_hora_inicio_viaje',
        'inicio_viaje',
        'fecha_hora_fin_viaje',
        'id_novedad',
        'origen_vuelo',
        'destino_vuelo',
        'cancelada_admin',
        'id_pasajero'
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getSolicitud($data){
        $movil = $this->db->table('t_solicitudes_tripulacion');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getSolicitudDetalles($data){
        $movil = $this->db->table('t_solicitudes_tripulacion');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function uploadTripulacion($data){
        $tarifa = $this->db->table('t_solicitudes_tripulacion');
        $tarifa->insertBatch($data);
        return $tarifa->get()->getResultArray();
    }
}
