<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MMovil;

require FCPATH.'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\SolicitudModel;
use monken\TablesIgniter;

class CMovil extends BaseController
{
    public function index()
    {
        $moviles = new MMovil();
        $datos['moviles'] = $moviles->getMoviles(); 

        return view('moviles/add', $datos);
    }

    public function save(){
        $moviles = new MMovil();        
        $datos = $this->request->getVar();
        
        $datosMovil = $moviles->getMovil(['identification'=>$datos['identification']]);

        if(count($datosMovil)>0){
            return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Usuario ya registrado, cedula repetida'
                ]);
        }

        if(!$moviles->save($datos)){
            return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Algo sucedio no se pudo guardar'
                ]);
        }else{
            return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Guardado!'
                ]);
        }
    }

    
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

    public function upload() {
        $db = \Config\Database::connect();
        $builder = $db->table('t_moviles')->truncate();
    
        $upload_file = $_FILES['upload_file']['name'];
        $extension = pathinfo($upload_file, PATHINFO_EXTENSION);
    
        if ($extension == 'csv') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
        } elseif ($extension == 'xls') {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } else {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        }
    
        $reader->setReadDataOnly(true);
    
        $spreadsheet = $reader->load($_FILES['upload_file']['tmp_name']);
    
        $sheet = $spreadsheet->getActiveSheet();
    
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();
    
        $headerRow = $sheet->rangeToArray('A1:' . $highestColumn . '1', NULL, TRUE, FALSE)[0];
    
        $dataRows = $sheet->rangeToArray('A2:' . $highestColumn . $highestRow, NULL, TRUE, FALSE);
    
        $rows = array();
        foreach ($dataRows as $row) {
            $rowData = array();
            foreach ($row as $key => $value) {
                $rowData[$headerRow[$key]] = $value;
            }
            $rows[] = $rowData;
        }
    
        $datos = [];

        foreach ($rows as $row) {
            $movil = $row['codigo'];
            $placa = $row['placa'];
            $celular = $row['celular'];
            $tipo_vehiculo = $row['tipo_vehiculo'];
            $estado = $row['estado'];
            $capacidad = $row['capacidad'];
            $marca = $row['marca'];
            $empresa = $row['empresa'];
            $modelo = $row['modelo'];
            //$password = password_hash('lidertur2022*', PASSWORD_DEFAULT);
    
            $data = [
                'movil' => $movil,
                'placa' => $placa,
                'celular' => $celular,
                'tipo_vehiculo' => $tipo_vehiculo,
                'estado' => $estado,
                'capacidad' => $capacidad,
                'marca' => $marca,
                'empresa' => $empresa,
                'modelo' => $modelo,

            ];
    
            $datos[] = $data;
        }
    
        $cargarMoviles = new MMovil();
        $cargarMoviles->insertBatch($datos);
    
        return redirect()->route('admin/Moviles')->with('msg', [
            'icon' => 'check',
            'type' => 'success',
            'body' => 'Moviles cargados.'
        ]);
    }

    
       /*  public function upload(){
            $db = \Config\Database::connect();
            $builder = $db->table('t_moviles')->truncate();

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
                    
                    $movil = $sheetData[$i][0];
                    $placa = $sheetData[$i][1];
                    $celular = $sheetData[$i][8];
                    $tipo_vehiculo = $sheetData[$i][2];
                    $estado = $sheetData[$i][3];
                    $capacidad = $sheetData[$i][4];
                    //$tipo_flota = $sheetData[$i][];
                    $marca = $sheetData[$i][5];
                    $empresa = $sheetData[$i][7];                    
                    $modelo = $sheetData[$i][6];
                    $password = password_hash('lidertur2022*', PASSWORD_DEFAULT);
                                 
                    //dd($data);
                    $data = [
                        
                        'movil' => $movil,
                        'placa' => $placa,
                        'celular' => $celular,
                        'tipo_vehiculo' => $tipo_vehiculo,
                        'estado' => $estado,
                        'capacidad' => $capacidad,
                        'marca' => $marca,
                        'empresa' => $empresa,
                        'modelo' => $modelo,
                        'password' => $password
                    ];
    
    
                    $cargarMoviles = new MMovil();
                    $cargarMoviles->insert($data);
                   
    
                }           
                
                return redirect()->route('admin/Moviles')
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Moviles cargados.'
                ]);
                
            }
    
        } */
    

}