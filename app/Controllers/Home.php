<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        //echo session('group_name'); exit();
        $group = session('group_name');
        //$group = null;
        if(isset($group)){
            return view('templates/'.$group.'_templates');
        }else{
            return view('login');
        }
        
    }
    public function dashboard_administrador()
    {
        return view('templates/bienvenido');
    }
    public function dashboard_coordinador()
    {
        return view('templates/bienvenido');
    }
    public function dashboard_interventor()
    {
        return view('templates/bienvenido');
    }

    public function dashboard_pasajero()
    {
        return view('templates/bienvenido');
    }

    public function dashboard_conductor()
    {
        return view('templates/bienvenido');
    }

    public function dash_conductor(){
        
        $db = \Config\Database::connect();
        
        if(session('group_name') == 'conductor'){
            //Solicitudes tripulacion
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->select('s.*, p.*');
            $builder->where('s.id_conductor = '.session('id_user'));
            $builder->where('s.id_novedad = 0');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes_tipulacion'] = $builder->get()->getResultArray();
            
            $builder = $db->table('t_solicitudes_tripulacion s');
            $builder->where('s.id_conductor = '.session('id_user'));
            $builder->selectSum('id_solicitud');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['total_registros_tripulacion'] = $builder->get();

        }



        if(session('group_name') == 'conductor'){
            //solicitudes Voucher
            $builder = $db->table('t_solicitudes_voucher s');
            $builder->select('s.*, p.*');
            $builder->where('s.id_conductor = '.session('id_user'));
            $builder->where('s.id_novedad = 0');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['solicitudes_voucher'] = $builder->get()->getResultArray();
            //$datos['total_registros_voucher'] = $builder->get()->getNumRows();

            $builder = $db->table('t_solicitudes_voucher s');
            $builder->where('s.id_conductor = '.session('id_user'));
            $builder->selectSum('id_solicitud');
            $builder->join('t_pasajeros p', 's.id_pasajero = p.id_pasajero');
            $datos['total_registros_voucher'] = $builder->get();


            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad');
            $builder->where(['rr.conductor'=>session('id_user')]);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.ruta', '');    
            $datos['rutas_recogidas'] = $builder->get()->getResultArray();

            $builder = $db->table('t_rutas_reparto rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad');
            $builder->where(['rr.conductor'=>session('id_user')]);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.ruta', '');    
            $datos['rutas_reparto'] = $builder->get()->getResultArray();

        }

        
        if(session('group_name') == 'conductor'){
            //Solicitudes conductor
            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad');
            $builder->where(['rr.conductor'=>session('id_user')]);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.ruta', '');
            //$datos['solicitudes_recogidas'] = $builder->get()->getNumRows();
            $datos['solicitudes_recogidas'] = $builder->get()->getResultArray();

            $builder = $db->table('t_rutas_recogidas rr');
            $builder->select('rr.*, sz.nombre as szname, z.nombre as zname, count(id_ruta) as cantidad');
            $builder->where(['rr.conductor'=>session('id_user')]);
            $builder->join('t_sub_zonas sz', 'rr.ruta = sz.id_sub_zona');
            $builder->join('t_zonas z', 'sz.id_zona = z.id_zona');
            $builder->groupBy('rr.ruta, rr.fecha, rr.hora_llegada');
            $builder->orderBy('rr.ruta', '');
            $datos['total_registros_recogidas'] = $builder->get()->getNumRows();
        }

        


        //dd($datos);

        return view('dashboard/conductor',$datos);
    }

}
