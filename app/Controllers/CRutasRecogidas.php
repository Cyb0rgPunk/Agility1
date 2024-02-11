<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MRutasRecogidas;
use App\Models\MConductor;
use App\Models\MMovil;
use App\Models\MZonas;
use App\Models\MPasajeros;

class CRutasRecogidas extends BaseController
{
    public function index($all_dates = null)
    {
        $db = \Config\Database::connect();

        if($all_dates != 1){            
            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad, 
            sum(rr.confirmacion = 1) as confirmados, sum(rr.confirmacion = 0) as rechazados,
            sum(rr.confirmacion is null) as sinestado');
            $month = date("m");
            $year = date("Y");
            $day = date("d");
            $date = date("Y-m-d");
            //$where = ['MONTH(rr.fecha) >=' =>$month,'YEAR(rr.fecha) >=' =>$year, 'DAY(rr.fecha) <=' => $day];
            //$where = ['LAST_DAY(rr.fecha)' => $date];
            //$builder->where($where);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            //$builder->orderBy('rr.ruta', '');
            $builder->orderBy('rr.hora_llegada ASC');
            $builder->orderBy('rr.fecha DESC');

        }
        
        if($all_dates == 1){
            $db = \Config\Database::connect();
            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad, 
            sum(rr.confirmacion = 1) as confirmados, sum(rr.confirmacion = 0) as rechazados,
            sum(rr.confirmacion is null) as sinestado');
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.fecha DESC');
        }

        if(session('group_name') == 'conductor'){
            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad, 
            sum(rr.confirmacion = 1) as confirmados, sum(rr.confirmacion = 0) as rechazados,
            sum(rr.confirmacion is null) as sinestado');
            $builder->where(['rr.conductor'=>session('id_user')]);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.ruta', '');
            
        }

        /*if(session('group_name') == 'coordinador'){
            $db = \Config\Database::connect();
            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad, 
            sum(rr.confirmacion = 1) as confirmados, sum(rr.confirmacion = 0) as rechazados,
            sum(rr.confirmacion is null) as sinestado');
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.ruta', '');
        }*/


        $datos['solicitudes'] = $builder->get()->getResultArray();

        //dd($datos);

        return view('rutas/recogidas/upload',$datos);
    }

    public function index_filtros(){
        $db = \Config\Database::connect();
        $first_date = date("Y-m-d", strtotime($_POST['fecha_inicio']));
        $second_date = date("Y-m-d", strtotime($_POST['fecha_fin']));

        $builder = $db->table('t_rutas_recogidas rr');
        $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad, 
        sum(rr.confirmacion = 1) as confirmados, sum(rr.confirmacion = 0) as rechazados,
        sum(rr.confirmacion is null) as sinestado');
        
        $builder->where('fecha >=', $first_date);
        $builder->where('fecha <=', $second_date);
        //$builder->where($where);
        $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
        $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
        $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
        $builder->orderBy('rr.hora_llegada ASC');
        $datos['solicitudes'] = $builder->get()->getResultArray();

        //dd($datos);

        return view('rutas/recogidas/upload',$datos);
    } 

    public function gestion_ruta_conductor($id_sub_zona = null, $hora_llegada = null, $fecha = null){
        $cargarRutas = new MRutasRecogidas();
        $datos['pasajeros'] = $cargarRutas->where(['hora_llegada' => $hora_llegada, 'ruta' => $id_sub_zona, 'fecha' => $fecha, 'conductor' => session('id_user')])->findAll();

        $sub_zona = new MZonas();
        $datos ['sub_zona'] = $sub_zona->where(['id_sub_zona' => $id_sub_zona])->findAll();

        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $conductores = new MConductor(); 
        $datos['conductores'] = $conductores->getConductores();

        $datos['id_ruta'] = $id_sub_zona;
        $datos['hora_llegada'] = $hora_llegada;
        $datos['fecha'] = $fecha;
              
        return view('rutas/recogidas/recogidas/gestion_conductor',$datos);

    }

    public function pasajeros_ruta($id_sub_zona = null, $hora_llegada = null, $fecha = null){
        //echo $fecha;
        //$cargarRutas = new MRutasRecogidas();
        //$datos['ruta']= $cargarRutas->where(['id_ruta' => $sub_zona])->findAll();

        $cargarRutas = new MRutasRecogidas();
        $datos['pasajeros'] = $cargarRutas->where(['hora_llegada' => $hora_llegada, 'ruta' => $id_sub_zona, 'fecha' => $fecha])->findAll();

        //dd($datos);

        $sub_zona = new MZonas();
        $datos ['sub_zona'] = $sub_zona->where(['id_sub_zona' => $id_sub_zona])->findAll();

        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $conductores = new MConductor(); 
        $datos['conductores'] = $conductores->getConductores();

        $datos['id_ruta'] = $id_sub_zona;
        $datos['hora_llegada'] = $hora_llegada;
        $datos['fecha'] = $fecha;
              


        //$datos['ruta'] = $ruta;
        //dd($datos);

        //echo "Ruta: ".$ruta;
        if(session('group_name') == 'conductor'){
            return view('rutas/recogidas/recogidas/gestion_conductor',$datos);
        } 
        if(session('group_name') == 'admin' || session('group_name') == 'coordinador'){
            return view('rutas/recogidas/recogidas/asignar',$datos);        
        } 
        

    }

    public function confirmar_ruta(){
              
        if(isset($_POST['btn_aceptar'])){
            $db = \Config\Database::connect();
            $builder = $db->table('t_rutas_recogidas rr');
            $sql_query = "UPDATE t_rutas_recogidas SET confirmacion = 1 WHERE ruta = ".$_POST['id_ruta']."  and conductor = ".session('id_user')." and fecha = '".$_POST['fecha']."' and hora_llegada = '".$_POST['hora_llegada']."'";
            //echo  $sql_query; exit();
            $builder = $db->query($sql_query);
        } 
        if(isset($_POST['btn_rechazar'])){
            $db = \Config\Database::connect();
            $builder = $db->table('t_rutas_recogidas rr');
            $sql_query = "UPDATE t_rutas_recogidas SET confirmacion = 0 WHERE ruta = ".$_POST['id_ruta']."  and conductor = ".session('id_user')." and fecha = '".$_POST['fecha']."' and hora_llegada = '".$_POST['hora_llegada']."'";            $builder = $db->query($sql_query);
        }        

        $ruta = "";

        if(!$builder){
            return redirect()->route(session('group_name').'/RutasRecogidas')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/RutasRecogidas')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Ruta asiganada con exito'
                ]);
        }

    }

    public function asistencia_ruta(){
         
       // dd($_POST['abordaron'][0]);

        $db = \Config\Database::connect();
        $builder = $db->table('t_rutas_recogidas rr');
        $sql_query = "UPDATE t_rutas_recogidas SET abordo = 1 WHERE id_ruta IN(".$_POST['abordaron'][0].");";
        $builder = $db->query($sql_query);
        $ruta = base_url(session('group_name').'/PasajerosRuta/'.$_POST['id_ruta'].'/'.$_POST['hora_llegada'].'/'.date('Y-m-d', strtotime($_POST['fecha'])));

        if(!$builder){
            return redirect()->to($ruta)
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->to($ruta)
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Se actualizo la asistenacia del pasajeros.'
                ]);
        }

    }
    public function asignar_ruta(){
        //echo "<h1>Agisnacion de ruta</h1>";
        
        $db = \Config\Database::connect();
        $builder = $db->table('t_rutas_recogidas rr');
        $sql_query = "SELECT id_ruta, fecha, numero_cc, nombre, direccion, barrio, hora_llegada, ruta as id_sub_zona FROM `t_rutas_recogidas` WHERE id_ruta IN (".$_POST['pasajeros'][0].")";
        //echo $sql_query;
        $builder = $db->query($sql_query);
        
        //dd($_POST['pasajeros']);

        $datos['pasajeros'] = $builder->getResultArray();
        
        $pasajeroModel = new MPasajeros();

        for ($i=0; $i < count($datos['pasajeros']) ; $i++) { 
            
            $user = $pasajeroModel->where('id_nacional', $datos['pasajeros'][$i]['numero_cc'])->first();
            if(!$user){
                $datos['pasajeros'][$i]['existe'] = "No registrado";
                $datos['pasajeros'][$i]['color_existe'] = "red";
            }else{
                $datos['pasajeros'][$i]['existe'] = "Registrado";
                $datos['pasajeros'][$i]['color_existe'] = "green";
            }
        }
        //$cc_pasajeros = explode(",", $_POST['pasajeros'][0]);
        
        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $conductores = new MConductor(); 
        $datos['conductores'] = $conductores->getConductores();
        $datos['rutas_asignar'] = $_POST['pasajeros'][0];

        $datos['id_ruta'] = $_POST['id_ruta'];
        $datos['hora_llegada'] = $_POST['hora_llegada'];
        $datos['fecha'] = $_POST['fecha'];
        //dd($datos);
        return view('rutas/recogidas/recogidas/asignar_movil',$datos);
    

        //dd($datos);      
    }


    public function asignar_movil_ruta(){
    
        $db = \Config\Database::connect();
        $builder = $db->table('t_rutas_recogidas rr');
        $sql_query = "UPDATE t_rutas_recogidas SET movil = ".$_POST['id_movil']." , conductor = ".$_POST['id_conductor'].", confirmacion = NULL WHERE id_ruta IN(".$_POST['rutas_asignar'].");";
        $builder = $db->query($sql_query);
        $ruta = base_url(session('group_name').'/PasajerosRuta/'.$_POST['id_ruta'].'/'.$_POST['hora_llegada'].'/'.date('Y-m-d', strtotime($_POST['fecha'])));

        if(!$builder){
            return redirect()->to($ruta)
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->to($ruta)
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Ruta asiganada con exito, esperando confirmación del conductor'
                ]);
        }

    }


    public function iniciar_ruta_conductor($id_sub_zona = null, $hora_llegada = null, $fecha = null){
        $cargarRutas = new MRutasRecogidas();
        $datos['pasajeros'] = $cargarRutas->where(['hora_llegada' => $hora_llegada, 'ruta' => $id_sub_zona, 'fecha' => $fecha, 'conductor' => session('id_user')])->findAll();

        $sub_zona = new MZonas();
        $datos ['sub_zona'] = $sub_zona->where(['id_sub_zona' => $id_sub_zona])->findAll();

        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $conductores = new MConductor(); 
        $datos['conductores'] = $conductores->getConductores();

        $datos['id_ruta'] = $id_sub_zona;
        $datos['hora_llegada'] = $hora_llegada;
        $datos['fecha'] = $fecha;
              
        return view('rutas/recogidas/recogidas/iniciar_ruta',$datos);

    }

    //Carga excel de las rutas recogidas    
    public function upload(){
        
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
        
        //echo $extension;
        
        if($extension == 'csv'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }elseif($extension == 'xls'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else{
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $reader->setReadDataOnly(true);
        //print_r($reader ); 
        
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        //print_r($spreadsheet );
        $sheetData = $spreadsheet->getActiveSheet()->toArray();

        //echo "<pre>";
        //print_r($sheetData );
        //dd($sheetData);

        $sheetcount = count($sheetData);
        $datos = [];
        if($sheetcount>1){
            for ($i=1; $i < $sheetcount; $i++) { 
                $fecha = strtotime($sheetData[$i][0]);
                $numero_cc = $sheetData[$i][1];
                $nombre = $sheetData[$i][2];
                $direccion = $sheetData[$i][3];
                $barrio = $sheetData[$i][4];
                $hora_llegada = $sheetData[$i][5];
                $hora_recogida = $sheetData[$i][6];
                $ruta = $sheetData[$i][7];
                //$movil = ""; 
                //$placa = $sheetData[$i][10];
                //$conductor = "";
                //$avantel = $sheetData[$i][12];
                //$documento = $sheetData[$i][13];
                
                
                $data = [
                    'fecha'=>date("Y-m-d", $fecha),
                    'numero_cc'=>$numero_cc,
                    'nombre'=>$nombre,
                    'direccion'=>$direccion,
                    'barrio'=>$barrio,
                    'hora_llegada'=>$hora_llegada,
                    'hora_recogida'=>$hora_recogida,
                    'ruta'=>$ruta,
                    //'movil'=>$movil,
                    //'placa'=>$placa,
                    //'conductor'=>$conductor,
                    //'avantel'=>$avantel,
                    //'documento'=>$documento
                ];

                //dd($data);
                $cargarSolicud = new MRutasRecogidas();
                $cargarSolicud->insert($data);
               

            }           
            
            $db = \Config\Database::connect();
            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname');
            //$builder->where(['rr.id_solicitud'=>$id_solicitud]);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta');
            $builder->orderBy('rr.ruta', '');

            $datos['solicitudes'] = $builder->get()->getResultArray();
            
            if(!$datos['solicitudes']){
                return redirect()->route(session('group_name').'/RutasRecogidas')
                        ->with('msg',[
                        'icon' => 'ban',
                        'type' => 'danger',
                        'body' => 'Algo sucedio no se pudo actualizar'
                    ]);
            }else{
                return redirect()->route(session('group_name').'/RutasRecogidas')
                        ->with('msg',[
                        'icon' => 'check',
                        'type' => 'success',
                        'body' => 'Actualizado!'
                    ]);
            }
            return view('rutas/recogidas/upload',$datos);
        }
    }
}
