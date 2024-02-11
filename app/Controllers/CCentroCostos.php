<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MCentroCosto;

class CCentroCostos extends BaseController
{
    public function index()
    {
        return view('centro_costos/add');
    }

     public function save()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('t_centro_costos')->truncate();

        $upload_file = $_FILES['upload_file']['tmp_name'];

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($upload_file);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($upload_file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

        $data = array_map(function ($row) {
            return [
                'codigo' => $row['A'],
                'nombre' => $row['B'],
            ];
        }, array_slice($sheetData, 1));

        $cargarCC = new MCentroCosto();
        $cargarCC->insertBatch($data);

        return redirect()->route('admin/CentroCostos')
            ->with('msg', [
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Centros de costos cargados.'
            ]);
    } 

    /* public function save(){
        $db = \Config\Database::connect();
        $builder = $db->table('t_centro_costos')->truncate();

        
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
                $codigo = $sheetData[$i][0];
                $nombre = $sheetData[$i][1];

                             
                //dd($data);
                $data = [
                    'codigo' => $codigo,
                    'nombre' => $nombre
                ];

                $cargarCC = new MCentroCosto();
                $cargarCC->insert($data);
               

            }           
            
            return redirect()->route('admin/CentroCostos')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'CC cargados.'
            ]);
            
        }

    } */


}
