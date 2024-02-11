<?php

namespace App\Models;

use CodeIgniter\Model;

class MSolicitudesVoucher extends Model
{
    protected $table            = 't_solicitudes_voucher';
    protected $primaryKey       = 'id_solicitud';

    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    //protected $protectFields    = true;
    protected $allowedFields    = 
    [
        'id_solicitud',
        'id_pasajero',
        'id_tipo_vehiculo',
        'estado_asignado',
        'id_movil',
        'id_conductor',
        'id_cliente',
        'id_operacion',
        'id_ciudad',
        'id_usuario_asigna',
        'id_usuario_solicita',
        'id_tipo_servicio',
        'origen',
        'destino',
        'fecha_hora',
        'fecha_hora_solicitud',
        'observacion',
        'cantidad_personas',
        'item',
        'voucher',
        'radicado',
        'trayecto',
        'motivo',
        'emp',
        'ceco',
        'viaje_en_servicio',
        'estado_conductor',
        'estado_pasajero',
        'cancelada_pasajero',
        'cancelada_conductor',
        'fecha_hora_inicio_viaje',
        'inicio_viaje',
        'fecha_hora_fin_viaje',
        'id_novedad',
    ];


    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
   // protected $deletedField  = 'deleted_at';

    public function getSolicitud($data){
        $movil = $this->db->table('t_solicitudes_voucher');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }

    public function getSolicitudDetalles($data){
        $movil = $this->db->table('t_solicitudes_voucher');
        $movil->where($data);
        return $movil->get()->getResultArray();
    }
}
