<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MSolicitudes;
use App\Models\MPasajeros;
use App\Models\MMovil;
use App\Models\MCentroCosto;
use App\Models\MConductor;
use App\Models\MTarifas;
use App\Models\MTarifasAdicionales;

class CSolicitudeVoucher extends BaseController
{
    public function index($id = null)
    {
        $pasajero = new MPasajeros();
        $datos['pasajero'] = $pasajero->where('id_pasajero',$id)->first();  
        
        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $centros_costos = new MCentroCosto();
        $datos['centros_costos'] = $centros_costos->getCC();

        return view('solicitudes_voucher/add', $datos);
    }

    //hacer solicitud
    public function solicitar(){

        $grupo = session('group_name');
        $id_user = session('id_user');
        
        if($grupo == 'requisidor'){
            $pasajeros = new MPasajeros();
            $datos['pasajeros'] = $pasajeros->getPasajerosUser($id_user);
            //echo $id_user; exit();
        }else{
            $pasajeros = new MPasajeros();
            $datos['pasajeros'] = $pasajeros->getPasajeros();
        }
         
        return view('solicitudes_voucher/lista_pasajeros',$datos);
        
    }
}
