<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MUser;
use App\Models\MGroups;
use App\Models\MPasajeros;

class CUser extends BaseController
{
    public function index()
    {
        $users = new MUser(); 
        $db = \Config\Database::connect();
        $builder = $db->table('t_users u');
        $builder->select('u.*, g.description');
        $builder->join('t_groups g', 'u.group = g.id_group'); 
        
        $typeGroups = new MGroups();        
        $datos['grupos'] = $typeGroups->getGroups();
        $datos['users'] = $builder->get()->getResultArray();

        return view('users/add', $datos);
        
    }

    public function save(){
        $user = new MUser();
        
        $datos = $this->request->getVar();

        $datos['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

        $datosUsuario = $user->getUser(['identification'=>$datos['identification']]);


        if(count($datosUsuario)>0){
            return redirect()->route('admin/AddUser')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Usuario ya registrado, cedula repetida'
                ]);
        }

         /*Se valida si va a ser un requisidor o supervisor y se registra en la tabla de pasajeros para que haga solicitudes para el. 
         if($datos['group'] == 3 || $datos['group'] == 5){
            //echo "agregar a pasajeros"; exit();
            $pasajeros = new MPasajeros();        
            //$datos = $this->request->getVar();
            
            $datosp = [
                'primer_nombre' => $datos['user'],
                'documento' => $datos['identification'],
                'celular' => $datos['phone'],
                'email' => $datos['email'],
            ];

            $datosp['password'] = password_hash($datos['password'], PASSWORD_DEFAULT);
            $datosp['group'] = 3;
            $datosp['id_user_registro'] = session('id_user');
            $pasajeros->save($datosp); 
        }*/

        if(!$user->save($datos)){
            return redirect()->route('admin/AddUser')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route('admin/AddUser')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Guardado!'
                ]);
        }


        
    }

    public function delete($id = null){
        $user = new MUser();

        if($user->delete(['id_user'=>$id])){
            return redirect()->route('admin/AddUser')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Eliminado con exito!'
            ]);
        }else{
            return redirect()->route('admin/AddUser')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo eliminar'
            ]);

        }           
    }

    public function edit($id = null){
        $user = new MUser();
        $typeGroups = new MGroups();
        $datos['user'] = $user->where('id_user',$id)->first();                
        $datos['grupos'] = $typeGroups->getGroups();

        //dd($datos);
        return view('users/edit', $datos);  
    }

    public function update(){
        $user = new MUser();
        
        $datos = $this->request->getVar();

        if($this->request->getVar('password')){
            $datos['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }else{
            $datos['password'] = $this->request->getVar('old_password');
        }

        //dd($datos);
        if(!$user->update($datos['id_user'],$datos)){
            return redirect()->route('admin/AddUser')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route('admin/AddUser')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }
    }
}