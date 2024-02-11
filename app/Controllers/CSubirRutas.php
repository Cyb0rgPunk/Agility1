<?php

namespace App\Controllers;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\MSolicitudes;
use monken\TablesIgniter;
use App\Controllers\BaseController;

class CSubirRutas extends BaseController
{
    public function index()
    {
        $cargarSolicud = new MSolicitudes();
        $datos['solicitudes'] = $cargarSolicud->orderBy('id_solicitud','ASC')->findAll();


        return view('subir_rutas/carga_datos',$datos);
    }
    
}
