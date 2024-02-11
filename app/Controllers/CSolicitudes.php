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
use App\Models\MSolicitudesTripulacion;
use App\Models\MSolicitudesVoucher;


class CSolicitudes extends BaseController
{

    public function actulizar_estado($tipo_solicitud = null, $estado = null, $id_solicitud = null){

        if($tipo_solicitud == 'tripulacion'){

            $solicitud = new MSolicitudesTripulacion();
            
            $solicitud->where(['id_solicitud'=>$id_solicitud]);       
            $solicitud->set([
                'estado_conductor' => $estado,
                'estado_asignado' => 1, 
                'id_conductor' => session('id_user') 
            ]);

        
            if(!$solicitud->update()){
                return redirect()->route(session('group_name').'/RutasPendientes')
                        ->with('msg',[
                        'icon' => 'ban',
                        'type' => 'danger',
                        'body' => 'Algo sucedio no se pudo actualizar'
                    ]);
            }else{
                return redirect()->route(session('group_name').'/RutasPendientes')
                        ->with('msg',[
                        'icon' => 'check',
                        'type' => 'success',
                        'body' => 'Actualizado!'
                    ]);
            }
        }

        if($tipo_solicitud == 'voucher'){

            $solicitud = new MSolicitudesVoucher();
            
            $solicitud->where(['id_solicitud'=>$id_solicitud]);       
            $solicitud->set([
                'estado_conductor' => $estado,
                'estado_asignado' => 1, 
                'id_conductor' => session('id_user') 
            ]);

        
            if(!$solicitud->update()){
                return redirect()->route(session('group_name').'/RutasPendientes')
                        ->with('msg',[
                        'icon' => 'ban',
                        'type' => 'danger',
                        'body' => 'Algo sucedio no se pudo actualizar'
                    ]);
            }else{
                return redirect()->route(session('group_name').'/RutasPendientes')
                        ->with('msg',[
                        'icon' => 'check',
                        'type' => 'success',
                        'body' => 'Actualizado!'
                    ]);
            }
        }

        
    } 
    
    

    public function inicia_viaje($tipo_solicitud = null, $id_solicitud = null){

       
        $datos['tipo_solicitud'] = $tipo_solicitud;
        $datos['id_solicitud'] = $id_solicitud;

        //dd($datos);
        //exit();

        if($tipo_solicitud == 'tripulacion'){

            $solicitud = new MSolicitudesTripulacion();
            
            $solicitud->where(['id_solicitud'=>$id_solicitud]);       
            $solicitud->set([
                'inicio_viaje' => 1,
                'fecha_hora_inicio_viaje' => date("Y-m-d H:i:s A"),  
            ]);
            $solicitud->update();
    
        }

        if($tipo_solicitud == 'voucher'){

            $solicitud = new MSolicitudesVoucher();
            
            $solicitud->where(['id_solicitud'=>$id_solicitud]);       
            $solicitud->set([
                'inicio_viaje' => 1,
                'fecha_hora_inicio_viaje' => date("Y-m-d H:i:s A"),  
            ]);
            $solicitud->update();
        }

        return view('solicitudes/novedad', $datos);

    }

    public function novedad(){

        if($_POST['tipo_solicitud'] == 'tripulacion'){

            $solicitud = new MSolicitudesTripulacion();
            
            $solicitud->where(['id_solicitud'=>$_POST['id_solicitud']]);       
            $solicitud->set([
                'id_novedad' => $_POST['id_novedad'],
                'fecha_hora_fin_viaje' => date("Y-m-d H:i:s A"),  
            ]);
            $solicitud->update();
    
        }

        if($_POST['tipo_solicitud'] == 'voucher'){

            $solicitud = new MSolicitudesVoucher();
            
            $solicitud->where(['id_solicitud'=>$_POST['id_solicitud']]);       
            $solicitud->set([
                'id_novedad' => $_POST['id_novedad'],
                'fecha_hora_fin_viaje' => date("Y-m-d H:i:s A"),  
            ]);
            $solicitud->update();
        }

        return redirect()->route(session('group_name').'/RutasPendientes')
                        ->with('msg',[
                        'icon' => 'check',
                        'type' => 'success',
                        'body' => 'Actualizado!'
                    ]);

    }


    public function index($id = null)
    {
        $pasajero = new MPasajeros();
        $datos['pasajero'] = $pasajero->where('id_pasajero',$id)->first();  
        
        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $centros_costos = new MCentroCosto();
        $datos['centros_costos'] = $centros_costos->getCC();

        return view('solicitudes/add', $datos);
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
         
        return view('solicitudes/lista_pasajeros',$datos);
        
    }

    //Guarda solicitud  
    public function save(){
        $solicitudes = new MSolicitudes();        
        $datos = $this->request->getVar(); 
        //dd($datos);   
        
        $fecha_hora = strtotime($datos['fecha_hora']);

        $datos['fecha_hora'] = date("Y-m-d H:i:s", $fecha_hora);
        $datos['fecha_hora_solicitud'] = date("Y-m-d H:i:s A");
        $datos['id_usuario_asigna'] = session('id_user');
        $datos['id_usuario_solicita'] = session('id_user');


        if(!$solicitudes->save($datos)){
            return redirect()->route(session('group_name').'/Historico')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/Historico')
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

    //Historial de solicitudes
    public function historial(){
        
        $db = \Config\Database::connect();
 
        if(session('group_name') == 'admin'){
            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*, p.*');
            $builder->where('s.estado_asignado = 0');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }    
       

        if(session('group_name') == 'pasajero'){
            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*, p.*');
            $builder->where('s.id_pasajero = '.session('id_user'));
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }

        if(session('group_name') == 'requisidor'){
            
            $solicitudes = new MSolicitudes();
            $datos['solicitudes'] = $solicitudes->getHistorialUsuario([session('id_user'),session('id_pasajero')]);
            
        }

        if(session('group_name') == 'super'){
            
            $solicitudes = new MSolicitudes();
            $datos['solicitudes'] = $solicitudes->getHistorialUsuario([session('id_user'),session('id_pasajero')]);
            
        }

         //dd($datos);   

        return view('solicitudes/historico', $datos);
    }
    
    
    //historial de solicitudes a las que se les asigno un movil 
    public function historial_asignado(){
        $db = \Config\Database::connect();
        $group = session('group_name');
              

        if($group == 'admin')
        {
            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*, p.*, p.celular as celularp, m.*');
            $builder->where('s.estado_asignado = 1');
            $builder->join('t_moviles m', 's.id_movil = m.id_movil');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();        
        }
        if($group == 'requisidor' )
        {
            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*, p.*, p.celular as celularp, m.*');
            $builder->where('s.estado_asignado = 1');
            $builder->join('t_moviles m', 's.id_movil = m.id_movil');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }
        if($group == 'supervisor' ){

        }



        //dd($datos);

        return view('solicitudes/historico_asignado', $datos);
    }

    //Retorja al JS los datos/detalles de la solicitud
    public function detalles($id_solicitud = null){
        
        $db = \Config\Database::connect();

            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*');
            $builder->where(['s.id_solicitud'=>$id_solicitud]);

            $datos['solicitud'] = $builder->get()->getResultArray();

        if($datos['solicitud'][0]['estado_asignado'] == 0){
            //hago la query
            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*, p.*, cc.nombre as ccs, cc.codigo as cccs');
            $builder->where(['s.id_solicitud'=>$id_solicitud]);
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $builder->join('t_centro_costos cc', 's.centro_costo = cc.id_cc');
            //Recupero los datos en un array
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }else{
            $builder = $db->table('t_solicitudes s');
            $builder->select('s.*, p.*, cc.nombre as ccs, cc.codigo as cccs, m.movil as codigo_movil, m.placa, c.nombre as nombrec, c.phone as phonec');
            $builder->where(['s.id_solicitud'=>$id_solicitud]);
            $builder->join('t_moviles m', 's.id_movil = m.id_movil');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $builder->join('t_centro_costos cc', 's.centro_costo = cc.id_cc');
            $builder->join('t_conductores c', 's.id_conductor = c.id_conductor');
            //Recupero los datos en un array
            $datos['solicitudes'] = $builder->get()->getResultArray();
        }
 
       

        //dd($datos);

        

        //dd($datos);
        //return $datos;
        echo json_encode($datos);
        //return view('solicitudes/asignar_movil',$datos);
    }
    
    public function detalles_asignado($id_solicitud = null){
        
        $db = \Config\Database::connect();
        $builder = $db->table('t_solicitudes s');
        $builder->select('s.*, p.*, cc.nombre as ccs, cc.codigo as cccs, m.movil as codigo_movil, m.placa, c.nombre as nombrec, c.phone as phonec, p.celular as celularp');
        $builder->where(['s.id_solicitud'=>$id_solicitud]);
        $builder->join('t_moviles m', 's.id_movil = m.id_movil');
        $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
        $builder->join('t_centro_costos cc', 's.centro_costo = cc.id_cc');
        $builder->join('t_conductores c', 's.id_conductor = c.id_conductor');
    
        //query para traer la tarifa 
        $builder_tarifa = $db->table('t_tarifas_adicionales ta');
        $builder_tarifa->where(['ta.id_solicitud'=>$id_solicitud]);
        
        //Recupero los datos en un array           
        $datos['solicitudes'] = $builder->get()->getResultArray();
        $datos['tarifas'] = $builder_tarifa->get()->getResultArray(); 

        //dd($datos);
        //return $datos;
        echo json_encode($datos);
        //return view('solicitudes/asignar_movil',$datos);
    } 

    //asignar solicitud 
    public function asignar($id_solicitud = null){
        
        $db = \Config\Database::connect();
        $builder = $db->table('t_solicitudes s');
        $builder->select('s.*, p.*');
        $builder->where(['s.id_solicitud'=>$id_solicitud]);
        $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
        $datos['solicitud'] = $builder->get()->getResultArray();

        //dd($builder); exit();

        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $conductores = new MConductor(); 
        $datos['conductores'] = $conductores->getConductores();

        $tarifas = new MTarifas(); 
        $datos['tarifas'] = $tarifas->getTarifas();

        return view('solicitudes/asignar_movil',$datos);
    }

    //cancelar solicitud
    public function cancelar($id_solicitud = null){
        

        $solicitud = new MSolicitudes();
        $solicitud->where(['id_solicitud'=>$id_solicitud]);       
        $solicitud->set([
            'cancelada'=> 1, 
        ]);
        
        
        if(!$solicitud->update()){
            return redirect()->route(session('group_name').'/Historico')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/Historico')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }

        return view('solicitudes/asignar_movil',$datos);
    } 

    public function asignar_confirmar(){
        
        $id_solicitud = $this->request->getVar('id_solicitud');
        $solicitud = new MSolicitudes();
        $solicitud->where(['id_solicitud'=>$id_solicitud]);       
        $solicitud->set([
            'id_movil'=> $this->request->getVar('id_movil'), 
            'estado_asignado' => 1, 'id_conductor' => $this->request->getVar('id_conductor') 
        ]);

        //Agrego a la tabla tarifas_adicionales la relcion de un tarifa adicional a una solicitud
        $tarifas_adicionales = new MTarifasAdicionales();
        $tarifas_adicionales->save($this->request->getVar());      
        
        if(!$solicitud->update()){
            return redirect()->route(session('group_name').'/Historico')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/Historico')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }

        return view('solicitudes/asignar_movil',$datos);
    } 
}
