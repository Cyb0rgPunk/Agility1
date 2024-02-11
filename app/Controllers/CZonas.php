<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MZonas;

class CZonas extends BaseController
{
    public function index()
    {
        $cargarDatos= new MZonas();
        $datos['sub_zonas'] = $cargarDatos->getAll();
        //dd($datos);

        return view('zonas/carga_sub_zonas', $datos);
    }

    public function save(){
        $sub_zonas = new MZonas();        
        $datos = $this->request->getVar();

        if(!$sub_zonas->save($datos)){
            return redirect()->route(session('group_name').'/SubZonas')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/SubZonas')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Guardado!'
                ]);
        }
    }

    public function edit($id = null){
        $sub_zona = new MZonas();
        $datos['sub_zona'] = $sub_zona->where('id_sub_zona',$id)->first();                

        //dd($datos);
        return view('zonas/editar_sub_zonas', $datos);  
    }

    public function update(){
        $sub_zona = new MZonas();
        
        $datos = $this->request->getVar();

        if(!$sub_zona->update($datos['id_sub_zona'],$datos)){
            return redirect()->route(session('group_name').'/SubZonas')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo actualizar'
                ]);
        }else{
            return redirect()->route(session('group_name').'/SubZonas')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Actualizado!'
                ]);
        } 
    }




    public function upload_sub_zonas(){
        echo "Este es el controlador, donde subimos las zonas";
        //dd($_POST);

        $db = \Config\Database::connect();
        $builder = $db->table('t_sub_zonas')->truncate();

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
        
        

        $sheetcount = count($sheetData);
        //dd($sheetData);

        $datos = [];
        if($sheetcount>1){
            for ($i=1; $i < $sheetcount; $i++) { 
                $id_zona = $sheetData[$i][0];
                $nombre = $sheetData[$i][1];
                $descripcion = $sheetData[$i][2];
                            
                
                $data = [
                    'id_zona' => $id_zona,
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,                   
                ];
                $datos[] = $data;
                

               // $cargarTarifa = new MTarifas();
               // $cargarTarifa->insert($data);
            }
            //dd($datos);
            $cargarDatos= new MZonas();
            $cargarDatos->isertAll($datos);
            
           // dd($datos);
            return redirect()->route(session('group_name').'/SubZonas')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Sub Zonas cargadas.'
            ]);
            
        }

    }
}
