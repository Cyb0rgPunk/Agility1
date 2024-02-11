<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MConductor;
use App\Models\MMovil;

class CConductores extends BaseController
{
    public function index()
    {
        $db      = \Config\Database::connect();

        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();
        
        $builder = $db->table('t_conductores tc');
        $builder->select('tc.*, tm.placa');
        $builder->join('t_moviles tm', 'tm.id_movil = tc.id_movil', 'left');
        
        
        $datos['conductores'] = $builder->get()->getResultArray(); 


        return view('conductores/add', $datos);
        
    }

    public function save(){
        

        $conductor = new MConductor();
        
        $datos = $this->request->getVar();

        $datos['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);

        $datosConductor = $conductor->getConductor(['identification'=>$datos['identification']]);


        if(count($datosConductor)>0){
            return redirect()->route('admin/AddConductor')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Conductor ya registrado, cedula repetida'
                ]);
        }

        //dd($datos);
        if(!$conductor->save($datos)){
            return redirect()->route('admin/AddConductor')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route('admin/AddConductor')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Guardado!'
                ]);
        }
    }

    public function delete($id = null){
        $conductor = new MConductor();

        if($conductor->delete(['id_conductor'=>$id])){
            return redirect()->route('admin/AddConductor')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Eliminado con exito!'
            ]);
        }else{
            return redirect()->route('admin/AddConductor')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo eliminar'
            ]);

        }           
    }

    public function edit($id = null){
        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles();

        $conductor = new MConductor();
        $datos['conductor'] = $conductor->where('id_conductor',$id)->first();                
        return view('conductores/edit', $datos);  
    }

    public function update(){
        $conductor = new MConductor();
        
        $datos = $this->request->getVar();

        /*
        Para cuando se agregue el campo password
        if($this->request->getVar('password')){
            $datos['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }else{
            $datos['password'] = $this->request->getVar('old_password');
        }
        */

        //dd($datos);
        if(!$conductor->update($datos['id_conductor'],$datos)){
            return redirect()->route('admin/AddConductor')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route('admin/AddConductor')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        }
    }

    public function upload(){
        $db = \Config\Database::connect();
        $builder = $db->table('t_conductores')->truncate();
 
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
                $cedula = $sheetData[$i][0];
                $nombre = $sheetData[$i][1];
                $celular = $sheetData[$i][2];
                $email = $sheetData[$i][3];

                             
                //dd($data);
                $data = [
                    'email' => $email,
                    'nombre' => $nombre,
                    'identification' => $cedula,
                    'phone' => $celular,
                    'password' => password_hash('conductor123', PASSWORD_DEFAULT), 
                ];

                $cargarCC = new MConductor();
                $cargarCC->insert($data);
               

            }           
            
            return redirect()->route('admin/AddConductor')
                ->with('msg',[
                'icon' => 'ban',
                'type' => 'success',
                'body' => 'Conductores cargados.'
            ]);
            
        }

    }
}
