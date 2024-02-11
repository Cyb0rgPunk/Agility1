<?php

namespace App\Controllers;
use App\Models\MUser;
use App\Models\MPasajeros;
use App\Models\MConductor;

class CLogin extends BaseController
{
    public function index()
    {
        $group = session('group_name');

        if(isset($group)){
            return view('templates/'.$group.'_templates');
        }else{
            return view('login');
        }
    }

    public function signin(){

        if(!$this->validate([
            'email' => 'required|valid_email',
            'password' => 'required'
        ])){
            return redirect()->back()
            ->with('errors', $this->validator->getErrors())
            ->withInput();        
        }

        $email = trim($this->request->getPost('email'));
        $password = $this->request->getPost('password');
        
        //llamado a todos los modelos de los tipos de usuarios
        $user = new MUser();
        $pasajero = new MPasajeros();
        $conductor = new MConductor();


        $datosUsuario = $user->getUser(['email'=>$email]);
        $datosPasajero = $pasajero->getPasajero(['correo'=>$email]);
        $datosConductor = $conductor->getConductor(['email'=>$email]);

        $id_pasajero = '';

        //Si es un usuario valida a que grupo pertenece y crea la session     
        if(count($datosUsuario)>0 && password_verify($password, $datosUsuario[0]['password'])){

            //echo "USUARIO"; exit(0);
            
            if($datosUsuario[0]['group'] == 1){ $name_group = 'admin';}
            if($datosUsuario[0]['group'] == 2){ $name_group = 'coordinador';}
            if($datosUsuario[0]['group'] == 3){ $name_group = 'interventor';}            

            //echo $name_group; exit(0);


            $data = [
                "user" => $datosUsuario[0]['user'],
                "email" => $datosUsuario[0]['email'],
                "group_name" => $name_group,
                "id_user" => $datosUsuario[0]['id_user']
            ];
            $session = session();
            $session->set($data);



            return redirect()->route(session('group_name').'/dashboard')
                ->with('msg',[
                    'type' => 'success',
                    'body' => 'Bienvenido '.session('user')
                ]);

        }

        if(count($datosPasajero)>0 && password_verify($password, $datosPasajero[0]['password'])){
            $name_group = 'pasajero';
            //echo "PASAJERO"; exit(0);
            //Si es un pasajero le crea la session 
            $datosPasajero= $pasajero->getPasajero(['correo'=>$email]);
            
            if(count($datosPasajero)>0 && password_verify($password, $datosPasajero[0]['password'])){
                $name_group = 'pasajero';
                $data = [
                    "user" => $datosPasajero[0]['primer_nombre'].' '.$datosPasajero[0]['primer_apellido'],
                    "group_name" => $name_group,
                    "id_user" => $datosPasajero[0]['id_pasajero']                    
                ];
                $session = session();
                $session->set($data);
    
                return redirect()->route(session('group_name').'/dashboard')
                    ->with('msg',[
                        'type' => 'success',
                        'body' => 'Bienvenido '.session('user')
                    ]);
            }else{
                return redirect()->back()
                ->with('msg',[
                    'type' => 'danger',
                    'body' => 'Correo o clave no valida!'
                ]);
            }
        }
        
        if(count($datosConductor)>0 && password_verify($password, $datosConductor[0]['password'])){
            $name_group = 'conductor';
            $data = [
                "user" => $datosConductor[0]['nombre'],
                "group_name" => $name_group,
                "id_user" => $datosConductor[0]['id_conductor']                    
            ];
            $session = session();
            $session->set($data);

            return redirect()->route(session('group_name').'/dashboard')
                ->with('msg',[
                    'type' => 'success',
                    'body' => 'Bienvenido '.session('user')
                ]);            
        }else{
            return redirect()->back()
                ->with('msg',[
                    'type' => 'danger',
                    'body' => 'Correo o clave no valida!'
                ]); 
            
        }
    }

    public function salir(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('/'));
    }
}
