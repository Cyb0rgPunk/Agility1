<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MTarifas;
use App\Models\MTarifasAdicionales;


class CTarifas extends BaseController
{
    public function index()
    {
        return view('tarifas/add');
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
        
        

        $sheetcount = count($sheetData);
        $datos = [];
        if($sheetcount>1){
            for ($i=1; $i < $sheetcount; $i++) { 
                $codigo = $sheetData[$i][0];
                $descripcion = $sheetData[$i][1];
                $tarifa = $sheetData[$i][2];
                            
                
                $data = [
                    'codigo' => $codigo,
                    'descripcion' => $descripcion,
                    'tarifa' => $tarifa
                ];
                $datos[] = $data;
                

               // $cargarTarifa = new MTarifas();
               // $cargarTarifa->insert($data);
            }
            //dd($datos);
            $cargarTarifa = new MTarifas();
            $cargarTarifa->isertTarifas($datos);
            
           // dd($datos);
            return redirect()->route('admin/Tarifas')
                ->with('msg',[
                'icon' => 'check',
                'type' => 'success',
                'body' => 'Tarifas cargadas.'
            ]);
            
        }

    }

    public function tarifa_adicional($id_solicitud = false, $solicita = false){
        
        $tarifas = new MTarifas();
        $datos['tarifas'] = $tarifas->getTarifas();
        $datos['id_solicitud'] = $id_solicitud;
        $datos['solicita'] = $solicita;

        //dd($solicita); exit();
        
        $db = \Config\Database::connect();
        //query para traer la tarifa 
        $builder_tarifa = $db->table('t_tarifas_adicionales ta');
        //$builder_tarifa->selectSum('tarifa');
        $builder_tarifa->where(['ta.id_solicitud'=>$id_solicitud, 'ta.solicita'=>$solicita]);
        $builder_tarifa->join('t_tarifas t', 't.id_tarifa = ta.id_tarifa'); 

        $datos['tarifas_adicionales'] = $builder_tarifa->get()->getResultArray();
        
        
        $datos['tarifa_total'] = $db->table('t_tarifas_adicionales ta')
        ->where(['ta.id_solicitud'=>$id_solicitud, 'ta.solicita'=>$solicita])
        ->join('t_tarifas t', 't.id_tarifa = ta.id_tarifa')
        ->selectSum('tarifa')->get()->getResultArray();

        //$datos['tarifa_total'] = (int)$datos['tarifa_total'];

        //dd($datos);
        return view('tarifas/tarifa_adicional',$datos);
        //dd($id_solicitud);

    }

    public function save_tarifa_adicional(){

        //dd($this->request->getVar('motivo'));   

        $tarifas_adicionales = new MTarifasAdicionales();
        $ruta = 'admin/TarifaAdicional/'.$this->request->getVar('id_solicitud').'/'.$this->request->getVar('solicita');

        //dd($_POST);exit();

        //echo $ruta; exit();
        if($tarifas_adicionales->save($this->request->getVar())){
            return redirect()->to($ruta)
                    ->with('msg',[
                    'icon' => 'check',
                    'type' => 'success',
                    'body' => 'Tarifa adicionada'
                ]);
        }else{
            return redirect()->route('admin/TarifaAdicional/'.$this->request->getVar('id_solicitud').'/'.$this->request->getVar('solicita'))
                    ->with('msg',[
                    'icon' => 'ban',
                    'type' => 'danger',
                    'body' => 'Error no se pudo adicionar'
                ]);
        }
        //return view('tarifas/tarifa_adicional',$datos);
    }
}
