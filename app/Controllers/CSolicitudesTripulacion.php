<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MSolicitudesTripulacion;
use App\Models\MPasajeros;
use App\Models\MMovil;
use App\Models\MCentroCosto;
use App\Models\MConductor;
use App\Models\MTarifas;
use App\Models\MTarifasAdicionales;

class CSolicitudesTripulacion extends BaseController
{
    public function index($id = null)
    {
        $pasajero = new MPasajeros();
        $datos['pasajero'] = $pasajero->where('id_pasajero',$id)->first();  
        
        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $centros_costos = new MCentroCosto();
        $datos['centros_costos'] = $centros_costos->getCC();

        return view('solicitudes_tripulacion/add', $datos);
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
         
        return view('solicitudes_tripulacion/lista_pasajeros',$datos);
        
    }

    //Guarda solicitud  
    public function save(){
        $solicitudes = new MSolicitudesTripulacion();        
        $datos = $this->request->getVar(); 
        //dd($datos);   
        
        $fecha_hora = strtotime($datos['fecha_hora']);

        $datos['fecha_hora'] = date("Y-m-d H:i:s", $fecha_hora);
        $datos['fecha_hora_solicitud'] = date("Y-m-d H:i:s A");
        $datos['id_usuario_asigna'] = session('id_user');
        $datos['id_usuario_solicita'] = session('id_user');
        $datos['estado_pasajero'] = 0;
        $datos['estado_conductor'] = 0;

        //echo  $datos['fecha_hora']; exit();

        if(!$solicitudes->save($datos)){
            return redirect()->route(session('group_name').'/HistoricoTripulacion')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/HistoricoTripulacion')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Guardado!'
                ]);
        }
    }


    //editar solicitud
    public function edit($id = null){
        $movil = new MMovil();
        $datos['movil'] = $movil->where('id_movil',$id)->first();        
        return view('moviles/edit', $datos);  
    }

    public function update(){
        $movil = new MMovil();       
        $datos = $this->request->getVar();
        
        if(!$movil->update($datos['id_movil'],$datos)){
            return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }
    }

        
    public function delete($id = null){
        $movil = new MMovil();
        //$user->delete(['id'=>$id]);

        if($movil->delete(['id_movil'=>$id])){
            return redirect()->route('admin/Moviles')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Eliminado con exito!'
            ]);
        }else{
            return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo eliminar'
            ]);

        }           
    }

    public function upload(){
        $db = \Config\Database::connect();
        $builder = $db->table('t_tarifas')->truncate();

        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
              
        if($extension == 'csv'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        }elseif($extension == 'xls'){
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        }else{
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
        $reader->setReadDataOnly(true);
        
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
        
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
        
        //dd($sheetData);
        

        $sheetcount = count($sheetData);
        $datos = [];
        if($sheetcount>1){
            for ($i=1; $i < $sheetcount; $i++) { 
                $tipo_vehiculo = $sheetData[$i][0];
                $ciudad = $sheetData[$i][1];
                $operacion = $sheetData[$i][2];
                $fecha_hora = $sheetData[$i][3];
                $vuelo = $sheetData[$i][4]; 
                $codigo = $sheetData[$i][5];
                $origen = $sheetData[$i][6];
                $destino = $sheetData[$i][7];
                $origen_vuelo = $sheetData[$i][8];
                $destino_vuelo = $sheetData[$i][9];
                $id_tipo_servicio = $sheetData[$i][10];
                $observacion = $sheetData[$i][11];
                $it = $sheetData[$i][12];
                $id_pasajero = $sheetData[$i][14];
                            
                
                $data = [
                    'id_tipo_vehiculo' => $tipo_vehiculo,
                    'id_ciudad' => $ciudad,
                    'id_operacion' => $operacion,
                    'fecha_hora' => $fecha_hora,
                    'vuelo' => $vuelo,
                    'codigo' => $codigo,
                    'origen' => $origen,
                    'destino' => $destino,
                    'origen_vuelo' => $origen_vuelo,
                    'destino_vuelo' => $destino_vuelo,
                    'id_tipo_servicio' => $id_tipo_servicio,
                    'observacion' => $observacion,
                    'it' => $it,
                    'id_pasajero' => $id_pasajero,
                ];
                $datos[] = $data;
                

               // $cargarTarifa = new MTarifas();
               // $cargarTarifa->insert($data);
            }
            //dd($datos);
            $cargarTripulacion= new MSolicitudesTripulacion();
            $cargarTripulacion->uploadTripulacion($datos);
            
           // dd($datos);
            return redirect()->route(session('group_name').'/HistoricoTripulacion')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Tarifas cargadas.'
            ]);
            
        }
    }

    //Historial de solicitudes
    public function historial(){
        
        $db = \Config\Database::connect();
 
        if(session('group_name') == 'admin'){
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            //$builder->where('s.estado_asignado = 0');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }    

        if(session('group_name') == 'coordinador'){
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            //$builder->where('s.estado_asignado = 0');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }    

        if(session('group_name') == 'interventor'){
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            //$builder->where('s.estado_asignado = 0');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }    
       

        if(session('group_name') == 'pasajero'){
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            $builder->where('s.id_pasajero = '.session('id_user'));
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }

        if(session('group_name') == 'conductor'){
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            $builder->where('s.id_conductor = '.session('id_user'));
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }

         //dd($datos);   

        return view('solicitudes_tripulacion/historico', $datos);
    }

    //asignar solicitud 
    public function asignar($id_solicitud = null){
            
        $db = \Config\Database::connect();
        $builder = $db->table('t_solicitudes_tripulacion s');
        $builder->select('s.*, p.*');
        $builder->where(['s.id_solicitud'=>$id_solicitud]);
        $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
        $datos['solicitud'] = $builder->get()->getResultArray();

       //dd($datos); exit();

        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        //$conductores = new MConductor(); 
        //$datos['conductores'] = $conductores->getConductores();
        $builder = $db->table('t_conductores tc');
        $builder->select('tc.*, tm.placa');
        $builder->join('t_moviles tm', 'tm.id_movil = tc.id_movil');
        
        $datos['conductores'] = $builder->get()->getResultArray(); 

        $tarifas = new MTarifas(); 
        $datos['tarifas'] = $tarifas->getTarifas();

        return view('solicitudes_tripulacion/asignar_movil',$datos);
    }
    
    //confirmo la asignacion de el movil, la trifa, tarifa adicional, conductor
    public function asignar_confirmar(){
        $db = \Config\Database::connect();
        $builder =  $db->table('t_conductores tc');
        $builder->select('id_movil')->where('id_conductor', $this->request->getVar('id_conductor'));
        $id_movil = $builder->get()->getResultArray(); 
        
        $id_solicitud = $this->request->getVar('id_solicitud');
        $solicitud = new MSolicitudesTripulacion();
        $solicitud->where(['id_solicitud'=>$id_solicitud]);       
        $solicitud->set([
            'id_movil'=> $id_movil[0]['id_movil'], 
            'estado_asignado' => 1, 
            'id_conductor' =>  $this->request->getVar('id_conductor')
        ]);

        //Agrego a la tabla tarifas_adicionales la relacion de una tarifa adicional a una solicitud
        $tarifas_adicionales = new MTarifasAdicionales();
        //dd($_POST);
        $tarifas_adicionales->save($_POST);      
        
        if(!$solicitud->update()){
            return redirect()->route(session('group_name').'/HistoricoTripulacion')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/HistoricoTripulacion')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }

        //return view('solicitudes_tripulacion/asignar_movil',$datos);
    }

    //Actualizar estado de la solicitud, aceptacion o rechaso del del conductor 

    //cancelar solicitud
    public function cancelar($id_solicitud = null){
        

        if(session('group_name') == 'conductor'){
            $solicitud = new MSolicitudesTripulacion();
            $solicitud->where(['id_solicitud'=>$id_solicitud]);
            $solicitud->set([
                'cancelada_conductor' => 1, 
            ]);
        }

        if(session('group_name') == 'pasajero'){
            $solicitud = new MSolicitudesTripulacion();
            $solicitud->where(['id_solicitud'=>$id_solicitud]);
            $solicitud->set([
                'cancelada_pasajero' => 1, 
            ]);
        }

        if(session('group_name') == 'admin'){
            $solicitud = new MSolicitudesTripulacion();
            $solicitud->where(['id_solicitud'=>$id_solicitud]);
            $solicitud->set([
                'cancelada_conductor' => 1,
                'cancelada_conductor' => 1,
                'cancelada_pasajero' => 1,  
            ]); 
        }
        
       
        if(!$solicitud->update()){
            return redirect()->to(session('group_name').'/HistoricoTripulacion')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->to(session('group_name').'/HistoricoTripulacion')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }

    }

    public function confirmacion_conductor($solicita = null, $id_solicitud=null){
        echo "Actulizar estado ".$solicita;


        dd($_GET);

    }
    
    //Retorna al JS los datos/detalles de la solicitud
    public function detalles($id_solicitud = null){

        
        $db = \Config\Database::connect();

        $builder = $db->table('t_solicitudes_tripulacion s');
        $builder->select('s.*');
        $builder->where(['s.id_solicitud'=>$id_solicitud]);

        $datos['solicitud'] = $builder->get()->getResultArray();
        

        if($datos['solicitud'][0]['estado_asignado'] == 0){
            //hago la query
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            $builder->where(['s.id_solicitud'=>$id_solicitud]);
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            
            //Recupero los datos en un array
            $datos['solicitudes2'] = $builder->get()->getResultArray();
        }else{
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*, m.movil as codigo_movil, m.placa, c.nombre as nombrec, c.phone as phonec, c.email as emailc');
            $builder->where(['s.id_solicitud'=>$id_solicitud]);
            $builder->join('t_moviles m', 's.id_movil = m.id_movil');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $builder->join('t_conductores c', 's.id_conductor = c.id_conductor');
            //Recupero los datos en un array
            $datos['solicitudes'] = $builder->get()->getResultArray();
            
        }

        echo json_encode($datos);

        
    }
}